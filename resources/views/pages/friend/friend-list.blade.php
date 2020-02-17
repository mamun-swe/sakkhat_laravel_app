@extends('layouts.app')
@section('content')

<div class="container friend">
    <div class="row">
        <div class="col-12">
            <h5>Your friends</h5>
            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif
        </div>
    </div>
    <div class="row mt-2">

        {{-- Friends --}}
        @foreach ($myfriends as $friends)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 friend-column">
            <div class="card border-0 text-center">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">

                        @if ($friends->profile_image == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$friends->profile_image}}" class="img-fluid">
                        @endif

                    </div>
                    <a href="{{route('profile.show', $friends->id )}}" class="text-capitalize font-weight-bold mb-1">{{$friends->name}}</a>
                </div>
            </div>
        </div>
        @endforeach

        @foreach ($friendTwo as $friendsTwo)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 friend-column">
            <div class="card border-0 text-center">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">

                        @if ($friendsTwo->profile_image == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$friendsTwo->profile_image}}" class="img-fluid">
                        @endif

                    </div>
                    <a href="{{route('profile.show', $friendsTwo->id )}}" class="text-capitalize font-weight-bold mb-1">{{$friendsTwo->name}}</a>
                </div>
            </div>
        </div>
        @endforeach
        


    </div>
</div>


@endsection