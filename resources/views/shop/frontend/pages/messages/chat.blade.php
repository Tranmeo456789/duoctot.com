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
            <p id="{{$val->id}}"><strong>{{$val->author}}:</strong> {{$val->content}}</p>
        @endforeach
    </div>
    <div>
        <form action="{{route('fe.messages.sendMessages')}}" method="post">
            {{ csrf_field() }}
            Name: <input type="text" name="author" value="" >
            <br>
            <br>
            Message: <textarea name="content" rows="4" cols="30" value="" style="width: 100%;"></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
    <script>
        var socket = io('http://localhost:5000')
        socket.on('chat:message', function(data){
            //console.log(data)
            if($('#'+data.id).length == 0){
                $('#data').append('<p><strong>'+data.author+':</strong> '+data.content+'</p>')
            }else{
                console.log('da co tin nhan')
            }
        })
    </script>

</body>
</html>