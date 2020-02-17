@extends('layouts.app')
@section('content')

<div class="container friend">
    <div class="row">
        <div class="col-12">
            <h5>Suggested friends</h5>
            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif
        </div>
    </div>
    <div class="row mt-2">

        @foreach ($users as $friends)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 friend-column">
                <div class="card border-0 text-center">
                    <div class="card-body py-4">
                        <div class="img-box rounded-circle">
                            @if ($friends->profile_image == '0')
                                <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                            @else
                                <img src="{{url('')}}/profile/{{$friends->profile_image}}" class="img-fluid">
                            @endif
                        </div>
                    <p class="text-capitalize font-weight-bold mb-1 mt-2">{{$friends->name}}</p>

                    {{-- Check Already Request Sent, Already Friend, Add Friend --}}
                    <?php
                        $check = DB::table('friedns')
                            ->where('friend_one', Auth::user()->id)
                            ->where('friend_two', '=', $friends->id)
                            ->first();
                        if($check){
                            if($check->status == 0){
                    ?>
                        <button disabled class="btn btn-sm btn-light shadow-none font-weight-bold px-4">Request Already Sent</button>
                    <?php 
                            } elseif ($check->status == 1) {
                    ?>
                        <button disabled class="btn btn-sm btn-light shadow-none font-weight-bold px-4">Already Friend</button>
                    <?php
                            }
                        }else{
                    ?>
                        <a href="{{route('friend.add',$friends->id)}}" class="btn btn-sm btn-info shadow-none font-weight-bold px-4">Add friend</a>
                    <?php 
                        }
                    ?>

                    </div>
                </div>
            </div>
        @endforeach
        
        
    </div>
</div>

@endsection