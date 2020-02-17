@extends('layouts.app')
@section('content')

<div class="container friend">
    <div class="row">
        <div class="col-12">
            <h5>Friend Requests</h5>
            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif
        </div>
    </div>
    <div class="row mt-2">

        {{-- Friends --}}
        @foreach ($requests as $friend)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 friend-column">
            <div class="card border-0 text-center">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">

                        @if ($friend->profile_image == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$friend->profile_image}}" class="img-fluid">
                        @endif

                    </div>
                    <a href="{{route('profile.show', $friend->id )}}" class="text-capitalize font-weight-bold mb-1">{{$friend->name}}</a>
                    <div class="mt-2">
                    <a href="{{route('request.accept',$friend->id)}}" class="btn btn-sm btn-primary shadow-none font-weight-bold px-4">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        


    </div>
</div>


@endsection