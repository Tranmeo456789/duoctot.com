const fs = require('fs');
// const https = require('https');
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

// Khởi tạo Socket.IO với server HTTPS
const io = socketIo(server, {
    cors: {
        origin: "https://socket.tdoctor.net", // Thay bằng domain của bạn
        methods: ["GET", "POST"]
    }
});

// Lắng nghe cổng 5000
server.listen(5000, () => {
    console.log('Server running on port 5000');
});

// Xử lý sự kiện kết nối
io.on('error', function(socket) {
    console.log('error: ' + socket);
});

io.on('connection', function(socket) {
    console.log('Có người vừa kết nối: ' + socket.id);
    socket.on('sendMessage', (data) => {
        io.emit('newMessage', { content: data.content, author: data.author });
    });
});

// Khởi tạo Redis
const redis = new Redis(6379);
redis.psubscribe("*", function(error, count) {
    // Xử lý lỗi nếu có
});

redis.on('pmessage', function(partner, channel, message) {
    console.log('partner: ' + partner);
    console.log('channel: ' + channel);
    console.log('message: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.message);
    console.log('send');
});
