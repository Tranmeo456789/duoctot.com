<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>

<body>
    <h1>Chat</h1>
    <div id="data">
        @foreach($messages as $val)
        <p><strong>{{$val->author}}:</strong> {{$val->content}}</p>
        @endforeach
    </div>
    <div>
        <form action="{{route('fe.messages.sendMessages')}}" method="post">
            {{ csrf_field() }}
            Name: <input type="text" name="author" id="author" value="">
            <br>
            User ID: <input type="text" name="user_id" id="user-id" value="">
            <br>
            Message: <textarea name="content" id="content" rows="4" cols="30" style="width: 100%;"></textarea>
            <button type="submit" id="message-form" class="btn btn-primary">Send</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
    <script>
        // Kết nối tới Socket.IO server
        var socket = io('https://socket.tdoctor.net/');
        socket.on('connect', function() {
            console.log('Connected to Socket.io server');

            // Tham gia phòng chat (tùy chỉnh theo yêu cầu, nếu có)
            // socket.emit('join', { roomId: 'room1' });
        });

        document.getElementById('message-form').addEventListener('click', function(e) {
            e.preventDefault();

            // Lấy dữ liệu từ form
            const content = document.getElementById('content').value;
            const userId = document.getElementById('user-id').value;
            const author = document.querySelector('input[name="author"]').value;

            // Cấu trúc dữ liệu cần gửi
            const messageData = {
                author: author,
                content: content,
                room_id: $roomId, // ID phòng, có thể lấy từ biến frontend hoặc input
                user_id: userId, // ID người dùng, có thể lấy từ session hoặc thông tin người dùng
                role: 0, // Role người dùng (0 - user, 1 - admin,...)
                created_at: new Date(), // Thời gian gửi tin nhắn
                user_send: author // Thông tin người gửi
            };

            // Gửi sự kiện 'sendMessage' tới server
            socket.emit('sendMessage', messageData);

            // Gửi dữ liệu tới server để lưu vào DB (Ajax request)
            // const formData = {
            //     _token: '{{ csrf_token() }}',
            //     author: author,
            //     content: content
            // };

            // $.ajax({
            //     url: "{{ route('fe.messages.sendMessages') }}",
            //     type: "POST",
            //     data: formData,
            //     success: function(response) {
            //         console.log('Tin nhắn đã được lưu vào DB');
            //     },
            //     error: function(xhr) {
            //         console.error('Lỗi khi lưu tin nhắn vào DB:', xhr.responseText);
            //     }
            // });

            // Xóa nội dung form sau khi gửi
            document.getElementById('content').value = '';
            document.getElementById('author').value = '';
        });

        // Lắng nghe sự kiện 'newMessage' từ server
        socket.on('newMessage', function(data) {
            console.log('Received new message:', data);

            // Cập nhật giao diện với tin nhắn mới
            const messageHtml = `<p><strong>${data.user_send}:</strong> ${data.content}</p>`;
            document.getElementById('data').innerHTML += messageHtml;
        });
    </script>
</body>

</html>