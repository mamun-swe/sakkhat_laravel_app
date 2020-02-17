@extends('layouts.app')
@section('content')

<div class="edit-post">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <h6 class="mb-2">Edit Post</h6>
                        @if(count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        @if(Session::has('success'))
                            <p class="text-success">{{Session::get('success')}}</p>
                        @endif
                        <form action="{{route('post.update',$data->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <textarea rows="10" class="form-control rounded-0 shadow-none" name="content">
                                    {{$data->content}}</textarea>
                            </div>
                            <a href="{{route('home')}}">Go Back</a>
                            <button type="submit" class="btn btn-info shadow-none float-right px-5"><b>Update</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection