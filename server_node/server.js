const fs = require('fs');
//const https = require('https');
const http = require('http');
const socketIo = require('socket.io');
const Redis = require('ioredis');
// Đọc chứng chỉ SSL
// const privateKey = fs.readFileSync('/etc/letsencrypt/live/tdoctor.vn/privkey.pem'); // Đường dẫn đến khóa riêng
// const certificate = fs.readFileSync('/etc/letsencrypt/live/tdoctor.vn/fullchain.pem'); // Đường dẫn đến chứng chỉ

// Tạo server HTTPS
// const server = https.createServer({
//     key: privateKey,
//     cert: certificate
// });
const server = http.createServer();

// Khởi tạo Socket.IO với server HTTP
const io = socketIo(server, {
    cors: {
        origin: "https://socket.tdoctor.net",  // Đảm bảo URL này là chính xác và được phép kết nối
        methods: ["GET", "POST"]
    }
});

// Lắng nghe cổng 5000
server.listen(5001, () => {
    console.log('Server running on port 5001');
});

// Xử lý sự kiện kết nối
io.on('connection', (socket) => {
    console.log('Có người vừa kết nối: ' + socket.id);

    // Lắng nghe sự kiện 'sendMessage' từ Flutter client
    socket.on('sendMessage', (data) => {
        console.log('Received message from Flutter:', data);

        // Phát sự kiện 'newMessage' tới tất cả các client (bao gồm cả client đang gửi)
        io.emit('newMessage', {
            room_id: data.room_id,       // Room ID
            content: data.content,       // Nội dung tin nhắn
            user_id: data.user_id,       // ID người gửi
            role: data.role || 0,   // Nếu có thể có role (mặc định là 'user')
            created_at: data.created_at, // Thời gian gửi tin nhắn
            user_send: data.user_send    // Thông tin người gửi (nếu có)
        });
    });

    // Xử lý sự kiện 'join' khi người dùng tham gia phòng
    socket.on('join', (data) => {
        console.log('User joined room:', data.roomId);
        socket.join(data.roomId); // Tham gia phòng (room)
    });

    // Xử lý sự kiện 'leave' khi người dùng rời phòng
    socket.on('leave', (data) => {
        console.log('User left room:', data.roomId);
        socket.leave(data.roomId); // Rời phòng (room)
    });

    // Xử lý sự kiện ngắt kết nối
    socket.on('disconnect', () => {
        console.log('User disconnected: ' + socket.id);
    });

    // Xử lý lỗi
    socket.on('error', (error) => {
        console.log('Socket error:', error);
    });
});

// Khởi tạo Redis
const redis = new Redis(6379);
redis.psubscribe("*", function(error, count) {
    if (error) {
        console.log("Error subscribing to Redis:", error);
    }
});

// Lắng nghe sự kiện từ Redis và phát lại qua Socket.IO
redis.on('pmessage', function(partner, channel, message) {
    console.log('Received message from Redis:', message);
    message = JSON.parse(message);

    // Phát sự kiện đến tất cả các client
    io.emit(channel + ':' + message.event, message.data);
});
