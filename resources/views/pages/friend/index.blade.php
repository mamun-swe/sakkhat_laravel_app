

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

        @foreach($all_peoples as $people)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                        @if ($people['image'] == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$people['image']}}" class="img-fluid">
                        @endif
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">{{$people['name']}}</a>

                    <div class="mt-2">
                        @if($people['status'] == 'pending')
                            <form action="{{ route('request.cancel', $people['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light text-black shadow-none font-weight-bold btn-block">Calcel Request</button>
                            </form>
                        @elseif(!$people['status'])
                        <form action="{{ route('request.send', $people['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Add Friend</button>
                        </form>
                        @endif
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

        @foreach($my_requests as $requests)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">{{$requests->name}}</a>
                    <div class="mt-2">
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Confirm</button>
                        </form>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light shadow-none font-weight-bold btn-block mt-2">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
       
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
