


<!-- Index -->
@extends('layouts.app')
@section('content')

<div class="container friend">

    <div class="row">
        <div class="col-12">
            <h5>Suggested Friends</h5>
            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif
            @if(Session::has('exist'))
                <p class="text-danger">{{Session::get('exist')}}</p>
            @endif
        </div>
    </div>

    <div class="row">


        {{gettype($all_peoples)}}

        @foreach($all_peoples as $suggested)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                        @if ($suggested->image == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$suggested->image}}" class="img-fluid">
                        @endif
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">{{$suggested->name}}</a>
                    <div class="mt-2">
                        <form action="{{ route('request.send', $suggested->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Add Friend</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <h5>Friend Requests</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">ccc</a>
                    <div class="mt-2">
                        <form action="{{ route('request.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Confirm</button>
                        </form>
                        <form action="{{ route('request.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light shadow-none font-weight-bold btn-block mt-2">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <div class="row">
        <div class="col-12">
            <h5>Your Friends</h5>
        </div>
    </div>

    <div class="row mb-2">

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">fdgddf</a>
                </div>
            </div>
        </div>
       
    </div>



</div>


@endsection



