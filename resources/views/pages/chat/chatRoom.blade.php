@extends('layouts.app')
@section('content')



<div class="chatting">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 m-auto">
                <div class="card border-0 shadow">
                    <div class="card-header bg-white">
                    
                        @if(count($errors) > 0)
                            <ul class="pl-0 m-0">
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none;" class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if(Session::has('success'))
                        <p class="text-success mb-0">{{Session::get('success')}}</p>
                        @endif
                    </div>
                    <div class="card-body">

                        @foreach($sortedMessages as $message)
                            @if($message['sender_id'] == auth()->user()->id)
                            <div class="my-message text-right">
                                <p>{{$message['message']}}</p>
                                <small>{{ \Carbon\Carbon::parse($message['time'])->format('M d, Y')}}</small>
                            </div>
                            @else
                            <div class="other-message">
                                <p>{{$message['message']}}</p>
                                <small>{{ \Carbon\Carbon::parse($message['time'])->format('M d, Y')}}</small>
                            </div>
                            @endif
                        @endforeach

                        
                    </div>
                    <div class="card-footer bg-white">
                    <form action="{{ route('message.sent') }}" method="post">
                        @csrf
                        <input type="hidden" name="reciver_id" value="{{$id}}">
                            <div class="input-group">
                                <textarea class="form-control rounded-0 shadow-none border-0 pl-0" placeholder="Write message ..." name="message_content" rows="2"></textarea>
                                <div class="input-group-prepend">
                                  <div class="input-group-text p-0 border-0 bg-white">
                                      <button type="submit" class="btn btn-primary shadow-none px-4 py-2 font-weight-bold">Send</button>
                                  </div>
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- <script>
    $(document).ready(function(){
            var id = (location.pathname).substr(10);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type : 'get',
                url:"/show-message/"+id,
                dataType: "JSON",
                success : function(response) {
                    var senderMsg = response[0];
                    var reciverMsg = response[1];
                    for(var i=0;i<senderMsg.length;i++){
                        sentMessages = senderMsg[i];
                        document.getElementById("senderMessages").innerHTML += '<p class="message mb-2" style="background: #3490dc;color: #fff;">' + sentMessages.message_content +'</p>';
                    }
                    for(var i=0;i<reciverMsg.length;i++){
                        recivedMsg = reciverMsg[i];
                        document.getElementById("reciverMessages").innerHTML += '<p class="message mb-2">' + recivedMsg.message_content +'</p>';
                    }
                        
                },
                error: function (err) {
                    if(err){
                        console.log(err);
                    }                            
                }
            });
    });
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->