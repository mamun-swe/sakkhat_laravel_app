@extends('layouts.app')
@section('content')

<div class="chat">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 m-auto">

            
                @foreach ($friendOne as $friend)
                <a href="{{route('chat.message', $friend->id)}}">
                    <div class="card border-0 mb-2 friend">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <div class="profile-img-box rounded-circle">
                                        @if ($friend->profile_image == '0')
                                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid profile-img">
                                        @else
                                            <img src="{{url('')}}/profile/{{$friend->profile_image}}" class="img-fluid profile-img">
                                        @endif
                                    </div>
                                </div>
                                <div class="pl-3 pt-3">
                                    <h6 class="text-capitalize font-weight-bold">{{$friend->name}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
