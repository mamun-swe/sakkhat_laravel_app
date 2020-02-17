@extends('layouts.app')
@section('content')

<div class="profile-edit">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 m-auto">
                <div class="card border-0">
                    <div class="card-body">
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

                        <button type="button" id="toggleProfile" class="btn btn-block rounded-0 shadow-none btn-secondary py-2 text-white">Update Profile Picture</button>
                        
                        <button type="button" id="toggleCover" class="btn btn-block rounded-0 shadow-none btn-secondary py-2 text-white">Update Cover Picture</button>

                        <div id="profileFormAnimate" class="form-box mt-3">
                            <form action="{{route('profile.update.image',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-2 text-center">
                                    <div class="file-upload">
                                        <label for="upload_profile" class="file-upload__label rounded-0 py-2 px-5">Choose Profile Picture</label>
                                        <input id="upload_profile" class="file-upload__input" type="file" name="profile_image">
                                    </div>
                                    
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-info rounded-0 shadow-none py-2 btn-block">Upload</button>
                                </div>
                            </form>
                        </div>
                        <div id="coverFormAnimate" class="form-box mt-3">
                            <form action="{{route('profile.update.cover',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-2 text-center">
                                    <div class="file-upload">
                                        <label for="upload_cover" class="file-upload__label rounded-0 py-2 px-5">Choose Cover Picture</label>
                                        <input id="upload_cover" class="file-upload__input" type="file" name="cover_image">
                                    </div>
                                    
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-info rounded-0 shadow-none py-2 btn-block">Upload</button>
                                </div>
                            </form>
                        </div>

                        {{-- <div class="file-upload">
                            <label for="upload_cover" class="file-upload__label mt-2 rounded-0 py-2 px-5">Choose Cover Picture</label>
                            <input id="upload_cover" class="file-upload__input" type="file" name="cover_image">
                        </div> --}}



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $("#profileFormAnimate").hide();
    $("#coverFormAnimate").hide();


    $('#toggleProfile').click(function() {
        $("#coverFormAnimate").hide();
        $('#profileFormAnimate').toggle('slow');
    });

    $("#toggleCover").click(function(){
        $("#profileFormAnimate").hide();
        $('#coverFormAnimate').toggle('slow');
    })
</script>

@endsection