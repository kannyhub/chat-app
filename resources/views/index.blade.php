<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat-app</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="top">
        kanhaiya pandit
    </div>
    <div class="message">
        @include('receive',['message' => 'Hey,whats up'])
    </div>
    <div class="bottom">
        <form action="">
            <input type="text" id="message">
            <button type="submit">Send</button>
        </form>
    </div>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('cdc69954ca99878e574a', {
          cluster: 'ap2'
        });
    
        var channel = pusher.subscribe('public');
        channel.bind('chat', function(data) {
          alert(JSON.stringify(data));
        });

        
        $('form').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url : '/broadcast',
                method : 'POST',
                headers : {
                    'X-Socket-Id' : pusher.connection.socket_id
                },
                data : {
                    _token : '{{ csrf_token() }}',
                    message: $('form #message').val(),
                }
            }).done(function(res) {
                console.log(res)
                $('form #message').val('');
            })
        })
      </script>
</body>
</html>