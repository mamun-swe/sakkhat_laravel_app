@extends('layouts.app')
@section('content')

<div class="profile">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 m-auto">
                @if ($user)
                <div class="card border-0 profile-card p-0 mb-3">
                    @if ($user->cover_image == '0')
                        <img src="{{url('')}}/static/cover_default.jpg" class="img-fluid cover-img">
                    @else
                        <img src="{{url('')}}/cover/{{$user->cover_image}}" class="img-fluid cover-img">
                    @endif
                        
                    <div class="custom-overlay">
                        <div class="d-flex">
                            <div class="p-3">
                                <div class="profile-picture-box rounded-circle">
                                    @if ($user->profile_image == '0')
                                        <img src="{{url('')}}/static/deafult_profile.png" class="img-fluid">
                                    @else
                                        <img src="{{url('')}}/profile/{{$user->profile_image}}" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                           
                            <div class="pt-5 pl-sm-2">
                                <h4 class="text-capitalize font-weight-bold text-white mt-3">{{ $user->name }}</h4>
                            </div>
                            <div class="ml-auto pt-5 pl-2 mt-3">
                                @if ( Auth::user()->id == $user->id )
                                    <a href="{{route('profile.edit', $user->id)}}"><i class="fas fa-pen text-white p-2"></i></a>
                                @endif
                                
                            </div> 
                        </div>
                    </div>
                </div>
                

                {{-- Posts --}}
                <div class="d-flex justify-content-start">
                    <div>
                        <button type="button" class="btn btn-light btn-sm shadow-none px-4 py-1 active"><h6 class="mb-0"><b>Posts</b></h6></button>
                    </div>
                <div>
                    <a href="{{route('friend.index')}}" class="btn btn-light btn-sm shadow-none px-4 py-1 active ml-1"><h6 class="m-0"><b>Friends</b></h6></a>
                </div>
                <div>
                    <a href="{{route('about.index')}}" class="btn btn-light btn-sm shadow-none px-4 py-1 active ml-1"><h6 class="m-0"><b>About</b></h6></a>
                </div>
                </div>
                @else
                <div class="text-center py-5">
                    <h5 class="text-danger">User not found</h5>
                </div>
                @endif
                <div class="posts my-3">
                    @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body px-0">
                        <div class="px-3">
                            <div class="d-flex">
                                <div class="ml-auto">
                                    
                                    @if( Auth::user()->id == $post->uid )
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm rounded-circle option-btn shadow-none dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('post.edit',$post->id)}}">Edit</a>
                                            <a class="dropdown-item p-0" href="">
                                                <form action="{{route('post.destroy',$post->id)}}" method="post"
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
                            <p class="mt-2">{{ \Illuminate\Support\Str::words($post->content, 27, '...') }} <a href="{{route('post.show',$post->id)}}" class="read-more">Read more</a></p>
                        </div>
                        <div class="img-box">
                            <img src="{{url('')}}/posts/{{$post->image}}" class="img-fluid">
                        </div>
                        <div class="footer-box pt-3 px-3">
                            <div class="d-flex">
                            <div><a href="{{route('post.show',$post->id)}}" class="btn btn-light shadow-none px-3 py-1">Comment</a></div>
                                <div class="ml-auto">
                                    <small>
                                        <?php
                                            $comments = \App\Comment::where('post_id', '=', $post->id)->count();
                                            echo $comments .' pepole commented';
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="card border-0 p-0" style="background: none;">
                        {{ $posts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection