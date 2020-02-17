@extends('layouts.app')
@section('content')

    <div class="show-post">
        <div class="container">
            @if (isset($data))
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="text-center mb-3">
                        <img src="{{url('')}}/posts/{{$data->image}}" class="img-fluid w-100">
                    </div>
                    <a href="{{route('profile.show', $user->id )}}" class="text-capitalize name">{{ $user->name }}</a>
                    <br>
                    <small class="text-muted">Posted on {{ date('D.m.Y', strtotime($data->created_at)) }}</small>
                    <p class="mt-3">{{ $data->content }}</p>
                </div>
                <div class="col-12 col-lg-5 py-3 py-lg-0">
                    <div class="card border-0 mb-3">
                        <div class="card-body p-3">

                            @if(count($errors) > 0)
                                <ul class="pl-0">
                                    @foreach ($errors->all() as $error)
                                    <li style="list-style: none;" class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if(Session::has('success'))
                                <p class="text-success">{{Session::get('success')}}</p>
                            @endif

                            <form action="{{route('comment.create')}}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $data->id }}">
                                <div class="form-group mb-0">
                                    <textarea name="comment" rows="4" class="form-control rounded-0 shadow-none border-0" placeholder="Write a comment ..."></textarea>
                                </div>
                                <div class="boder mt-1 mb-2"></div>
                                <button type="submit" class="btn btn-sm btn-block btn-info shadow-none"><b>Comment</b></button>
                            </form>

                        </div>
                    </div>
                    <div class="card mb-3 border-0">
                        <div class="card-body">
                            <h6><b>Comments</b></h6>
                            <div class="boder mb-2"></div>

                           
                            <div id="comments"></div>
                        
                          

                        </div>
                    </div>
                </div>
            </div>
            @elseif(isset($message))
            <div class="row">
                <div class="col-12 text-center py-3">
                    <h5 class="text-danger">{{ $message }}</h5>
                </div>
            </div>
            @endif
        </div>
    </div>

    

    <script>
        $(document).ready(function(){
                var id = (location.pathname).substr(6);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type : 'get',
                    url:"/show-comment/"+id,
                    dataType: "JSON",
                    success : function(response) {
                        var comments = response[0];
                        for(var i=0;i<comments.length;i++){
                            myComments = comments[i];
                            console.log(myComments);
                            
                            document.getElementById("comments").innerHTML += 
                            '<div><a href="">' + myComments.name + '</a><p>'+ myComments.comment + '</p></div>';
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

@endsection
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>