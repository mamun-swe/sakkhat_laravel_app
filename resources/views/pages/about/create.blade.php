@extends('layouts.app')
@section('content')

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 m-auto">
                <h4>Add your information</h4>
                @if(Session::has('success'))
                    <p class="text-success">{{Session::get('success')}}</p>
                @endif
            </div>

            <div class="col-12 col-lg-8 m-auto mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form action="{{ route('about.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <input 
                                            type="text"
                                            name="phone"
                                            class="form-control shadow-none"
                                            placeholder="Phone number"
                                            required    
                                        >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="school"
                                                class="form-control shadow-none"
                                                placeholder="School"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="school_year"
                                                class="form-control shadow-none"
                                                placeholder="Passing year"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="college"
                                                class="form-control shadow-none"
                                                placeholder="College"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="college_year"
                                                class="form-control shadow-none"
                                                placeholder="Passing year"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="university"
                                                class="form-control shadow-none"
                                                placeholder="University"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="university_year"
                                                class="form-control shadow-none"
                                                placeholder="Passing year"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input 
                                                type="text"
                                                name="address"
                                                class="form-control shadow-none"
                                                placeholder="Address"
                                                required    
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary shadow-none px-4">Submit</button>
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
