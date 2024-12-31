@extends('master')
@section('content')
<style>
    p{
        margin : 0;
    }
    .received-msg {
        background-color: #252525;
        border-radius: 10px;
        margin:5px;
    }
    .received-msg small {
        color: #fff;
        font-size: 11px;
        font-weight: 600;
    }
    .sent-msg small{
        color: #000;
        font-size: 11px;
        font-weight: 600;
    }
    .sent-msg{
        background: #d6d4d4;
        border-radius: 10px;
        margin:5px;
    }
</style>
    <div class="row">
        <div class="col-8" style="background-color: #a2a2a2">
            <h3>{{ $room->name }}</h3>
        </div>
        <div class="col-4" style="background-color: #f6f6f6">
            <div class="row">
                <div class="col-12" style="background: #6e757c">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle my-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          All Members
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">{{ $room->admin->name }} (Admin)</a></li>
                          @foreach ($room->attendee as $attendee)
                            <li><a class="dropdown-item" href="#">{{ $attendee->name }}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 messageArea" style="min-height:77vh; overflow-y:auto; max-height:77vh;">
                    
                </div>
                <div class="col-12" style="height:7vh;">
                    <form>
                    <div class="input-group my-2">
                        <input type="text" class="form-control" id="message" required placeholder="Type message......">
                        <button class="btn btn-secondary" type="button" id="send-btn">Send</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('cdc69954ca99878e574a', {
          cluster: 'ap2'
        });
    
        var channel = pusher.subscribe('public');
        channel.bind('chat', function(data) {
            let room = @json($room);
            if (room.id == data.room.id) {
                let dateTime = getDateTime();
                let receivedMessageHtml = `
                                            <div class="row received-msg-row">
                                                <div class="col-8 received-msg">
                                                    <small>${data.sender.name}</small>
                                                    <p class="text-light">${data.message}</p>
                                                    <small>${dateTime}</small>
                                                </div>
                                            </div>
                                        `;
                $('.messageArea').append(receivedMessageHtml);
            }
        });

        
        $('form').submit(function(event) {
            event.preventDefault();
            let message = $('form #message').val();
            let dateTime = getDateTime();
            let senddMessageHtml = `
                                        <div class="row justify-content-end">
                                            <div class="col-8 sent-msg">
                                                <small>You</small>
                                                <p>${message}</p>
                                                <small>${dateTime}</small>
                                            </div>
                                        </div>
                                    `;
            $('.messageArea').append(senddMessageHtml);
            $('form #message').val('');
            $.ajax({
                url : '/broadcast',
                method : 'POST',
                headers : {
                    'X-Socket-Id' : pusher.connection.socket_id
                },
                data : {
                    _token : '{{ csrf_token() }}',
                    message: message,
                    room : @json($room)
                }
            }).done(function(res) {
               
            })
        })

        function getDateTime() {
            let now = new Date();
            let formattedDateTime = now.toLocaleString();
            return formattedDateTime;
        }
      </script>
@endsection