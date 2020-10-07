@extends('layouts.app')

@section('content')
<div class="timeline">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 m-auto">
                {{-- Make post --}}
                <div class="card">
                    <div class="card-body p-2">
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
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group mb-2">
                                <textarea class="form-control rounded-0 shadow-none" rows="2" placeholder="Post ..." name="content"></textarea>
                            </div>
                            <div class="mb-2">
                                <div class="file-upload">
                                    <label for="upload" class="file-upload__label m-0">Photo</label>
                                    <input id="upload" class="file-upload__input" type="file" name="image">
                                </div>
                            </div>
                            <div class="boder mb-2"></div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-block btn-info shadow-none py-1 text-light"><b>Post</b></button>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- Showing Posts --}}
                <div class="posts my-3">
                    @foreach ($posts as $postitem)

                    <div class="card mb-3">
                        <div class="card-body px-0">
                        <div class="px-3">
                            <div class="d-flex">
                                <div>
                                    <a href="{{route('profile.show', $postitem->uid )}}" class="text-capitalize name">{{ $postitem->name }}</a>
                                    <br>
                                    <small class="text-muted">Post on: {{ date('D.m.Y', strtotime($postitem->created_at)) }}</small>
                                </div>
                                <div class="ml-auto">
                                    
                                    @if( Auth::user()->id == $postitem->uid )
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm rounded-circle option-btn shadow-none dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('post.edit',$postitem->id)}}">Edit</a>
                                            <a class="dropdown-item p-0" href="">
                                                <form action="{{route('post.destroy',$postitem->id)}}" method="post"
                                                    onsubmit="return confirm('Are you sure ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn p-0 shadow-none btn-block text-left pl-4 py-1">Delete</button>
                                                </form>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-2">{{ \Illuminate\Support\Str::words($postitem->content, 27, '...') }} <a href="{{route('post.show',$postitem->id)}}" class="read-more">Read more</a></p>
                        </div>
                        <div class="img-box">
                            <img src="{{url('')}}/posts/{{$postitem->image}}" class="img-fluid">
                        </div>
                        <div class="footer-box pt-3 px-3">
                            <div class="d-flex">
                            <div><a href="{{route('post.show', $postitem->id)}}" class="btn btn-light shadow-none px-3 py-1">Comment</a></div>
                                <div class="ml-auto">
                                    <small>
                                    <?php
                                        $comments = \App\Comment::where('post_id', '=', $postitem->id)->count();
                                        echo $comments .' pepole commented';
                                    ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                        
                    @endforeach
                    
                </div>
                <div class="col-12 text-center">
                    {{ $posts->links() }}
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
