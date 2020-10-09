@extends('layouts.app')
@section('content')

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 m-auto">
                <h4>Edit your information</h4>
                @if(Session::has('success'))
                    <p class="text-success">{{Session::get('success')}}</p>
                @endif
            </div>

            <div class="col-12 col-lg-8 m-auto mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form action="{{ route('about.update', $about->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <small>Phone</small>
                                        <input 
                                            type="text"
                                            name="phone"
                                            class="form-control shadow-none"
                                            value="{{$about->phone}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>School</small>
                                        <input 
                                            type="text"
                                            name="school"
                                            class="form-control shadow-none"
                                            value="{{$about->school}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>Passing year</small>
                                        <input 
                                            type="text"
                                            name="school_year"
                                            class="form-control shadow-none"
                                            value="{{$about->school_year}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>College</small>
                                        <input 
                                            type="text"
                                            name="college"
                                            class="form-control shadow-none"
                                            value="{{$about->college}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>Passing year</small>
                                        <input 
                                            type="text"
                                            name="college_year"
                                            class="form-control shadow-none"
                                            value="{{$about->college_year}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>University</small>
                                        <input 
                                            type="text"
                                            name="university"
                                            class="form-control shadow-none"
                                            value="{{$about->university}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <small>Passing year</small>
                                        <input 
                                            type="text"
                                            name="university_year"
                                            class="form-control shadow-none"
                                            value="{{$about->university_year}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <small>Address</small>
                                        <input 
                                            type="text"
                                            name="address"
                                            class="form-control shadow-none"
                                            value="{{$about->address}}"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary shadow-none px-4">Update</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
