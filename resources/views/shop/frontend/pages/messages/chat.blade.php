<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
</head>
<body>
<h1>chat di</h1>
<div id="data">
    @foreach($messages as $val)
        <p><strong>{{$val->author}}:</strong> {{$val->content}}</p>
    @endforeach
</div>
<div>
    <form action="{{route('fe.messages.sendMessages')}}" method="post" >
        {{ csrf_field() }}
        Name: <input type="text" name="author" id="author" value="" >
        <br>
        <br>
        Message: <textarea name="content" id="content" rows="4" cols="30" value="" style="width: 100%;"></textarea>
        <button type="submit" id="message-form" class="btn btn-primary">Send</button>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
<script>
    // Kết nối tới Socket.IO server
    var socket = io('https://103.1.236.126:5000/');
    socket.on('connect', function() {
        console.log('Connected to Socket.io server');
    });

    document.getElementById('message-form').addEventListener('click', function(e) {
        e.preventDefault();

        // Lấy dữ liệu từ form
        const content = document.getElementById('content').value;
        const author = document.querySelector('input[name="author"]').value;

        socket.emit('sendMessage', {
            author: author,
            content: content
        });

        const formData = {
            _token: '{{ csrf_token() }}',
            author: author,
            content: content
        };

        $.ajax({
            url: "{{ route('fe.messages.sendMessages') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                console.log('Tin nhắn đã được lưu vào DB');
            },
            error: function(xhr) {
                console.error('Lỗi khi lưu tin nhắn vào DB:', xhr.responseText);
            }
        });

        document.getElementById('content').value = '';
        document.getElementById('author').value = '';
    });

    socket.on('newMessage', function(data) {
        const messageHtml = `<p><strong>${data.author}:</strong> ${data.content}</p>`;
        document.getElementById('data').innerHTML += messageHtml;
    });
</script>


</body>
</html>

