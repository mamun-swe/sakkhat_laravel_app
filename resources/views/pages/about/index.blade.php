@extends('layouts.app')
@section('content')

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 m-auto">
                <h4>About of {{auth()->user()->name}}</h4>
            </div>

            <div class="col-12 col-lg-8 m-auto mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-0 pt-3">

                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td><h5>Name</h5></td>
                                    <td><p>{{auth()->user()->name}}</p></td>
                                </tr>
                                <tr>
                                    <td><h5>E-mail</h5></td>
                                    <td><p>{{auth()->user()->email}}</p></td>
                                </tr>

                                @if($about)
                                <tr>
                                    <td><h5>Phone</h5></td>
                                    <td><p>{{$about->phone}}</p></td>
                                </tr>
                                <tr>
                                    <td><h5>School</h5></td>
                                    <td><p class="text-capitalize">{{$about->school}} -[ {{$about->school_year}} ]</p></td>
                                </tr>
                                <tr>
                                    <td><h5>College</h5></td>
                                    <td><p class="text-capitalize">{{$about->college}} -[ {{$about->college_year}} ]</p></td>
                                </tr>
                                <tr>
                                    <td><h5>University</h5></td>
                                    <td><p class="text-capitalize">{{$about->university}} -[ {{$about->university_year}} ]</p></td>
                                </tr>
                                <tr>
                                    <td><h5>Address</h5></td>
                                    <td><p class="text-capitalize">{{$about->address}}</p></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="text-right px-4">
                            @if($about)
                            <a href="{{ route('about.edit', $about->id) }}" type="button" class="btn py-1 px-3 btn-info text-white shadow-none">Edit</a>
                            @else 
                            <a href="{{ route('about.create') }}" type="button" class="btn py-1 px-3 btn-info text-white shadow-none">Add Yourself</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@endsection
