

@extends('layouts.app')
@section('content')

<div class="container friend">

    <div class="row">
        <div class="col-12">

            @if($all_suggesetd_peoples)
            <h5>Suggested Friends ( {{count($all_suggesetd_peoples)}} )</h5>
            @else
            <h5>Suggested Friends (0)</h5>
            @endif

            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif
            @if(Session::has('exist'))
                <p class="text-danger">{{Session::get('exist')}}</p>
            @endif
        </div>
    </div>

    <!-- Suggested Peoples -->
    <div class="row">
        @foreach($all_suggesetd_peoples as $people)
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
                        <form action="{{ route('request.send', $people['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Add Friend</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Friends request me for add -->
    <div class="row">
        <div class="col-12">
            @if($requested_to_me)
            <h5>Friend Requests ( {{count($requested_to_me)}} )</h5>
            @else
            <h5>Friend Requests (0)</h5>
            @endif
        </div>
    </div>

    <div class="row">
        @foreach($requested_to_me as $requests)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                            <!-- <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid"> -->
                        @if ($requests['image'] == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$requests['image']}}" class="img-fluid">
                        @endif
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">{{$requests['name']}}</a>
                    <div class="mt-2">
                        <form action="{{ route('request.accept', $requests['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary shadow-none font-weight-bold btn-block">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Sent Friend requests -->
    <div class="row">
        <div class="col-12">
            @if($sent_requests_by_me)
            <h5>Sent Requests ( {{count($sent_requests_by_me)}} )</h5>
            @else
            <h5>Sent Requests (0)</h5>
            @endif
        </div>
    </div>

    <div class="row">
        @foreach($sent_requests_by_me as $requests)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                        @if ($requests['image'] == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$requests['image']}}" class="img-fluid">
                        @endif
                    </div>
                    <a href="" class="text-capitalize font-weight-bold mb-1">{{$requests['name']}}</a>
                    <div class="mt-2">
                        <form action="{{ route('request.cancel', $requests['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light shadow-none font-weight-bold btn-block">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- My Friends -->
    <div class="row">
        <div class="col-12">
            @if($all_my_friends)
            <h5>Your Friends ( {{count($all_my_friends)}} )</h5>
            @else
            <h5>Your Friends (0)</h5>
            @endif
        </div>
    </div>

    <div class="row mb-2">

        @foreach($all_my_friends as $friend)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 friend-column px-2">
            <div class="card border-0 text-center shadow-sm">
                <div class="card-body py-4">
                    <div class="img-box rounded-circle mb-2">
                        @if ($friend['image'] == '0')
                            <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                        @else
                            <img src="{{url('')}}/profile/{{$friend['image']}}" class="img-fluid">
                        @endif
                    </div>
                    <a href="{{ route('profile.show', $friend['id']) }}" class="text-capitalize font-weight-bold mb-1">{{$friend['name']}}</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>



</div>


@endsection
