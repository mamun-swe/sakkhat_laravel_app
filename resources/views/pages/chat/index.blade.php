@extends('layouts.app')
@section('content')

<div class="chat">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 m-auto">

            
                @foreach ($all_my_friends as $friend)
                <a href="{{route('chat.message', $friend['id'])}}">
                    <div class="card friend rounded-0 border-left-0 border-top-0 border-right-0 border-bottom">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <div class="profile-img-box rounded-circle">
                                        @if ($friend['image'] == '0')
                                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid profile-img">
                                        @else
                                            <img src="{{url('')}}/profile/{{$friend['image']}}" class="img-fluid profile-img">
                                        @endif
                                    </div>
                                </div>
                                <div class="pl-3 pt-3">
                                    <h6 class="text-capitalize font-weight-bold">{{$friend['name']}}</h6>
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
