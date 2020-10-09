<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sakkhat</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
       
        <div class="custom-nav bg-white p-3 px-lg-5 text-right border-bottom">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">go to Tmeline</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-3">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="banner">
            <div class="overlay">
                <div class="flex-center flex-column text-center">
                    <h1 class="font-weight-bold text-white mb-4">Sakkhat</h1>
                    <a href="{{ route('home') }}" class="btn rounded-0 shadow-none">Let's Start</a>
                </div>
            </div>
        </div>

        <div class="text-center py-5 section-1">
            <div class="py-lg-5">
                <h2>10,000+</h2>
                <h4>Happy user</h4>
            </div>
        </div>

        <div class="section-2">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 text-center">
                            <h2 class="text-white mb-4">User Profile</h2>
                            <img src="{{url('')}}/static/profile.png" class="img-fluid">
                        </div>
                        <div class="col-12 col-lg-4 py-5 mt-lg-5">

                            <div class="d-flex mb-5 pr-3">
                                <div><i class="fas fa-users rounded-circle text-dark"></i></div>
                                <div class="ml-auto pl-4">
                                    <h5 class="text-white">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</h5>
                                </div>
                            </div>

                            <div class="d-flex mb-5 pr-3">
                                <div><i class="fab fa-telegram-plane rounded-circle text-dark icon-2"></i></div>
                                <div class="ml-auto pl-4">
                                    <h5 class="text-white">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</h5>
                                </div>
                            </div>

                            <div class="d-flex mb-5 pr-3">
                                <div><i class="fas fa-sync-alt rounded-circle text-dark icon-3"></i></div>
                                <div class="ml-auto pl-4">
                                    <h5 class="text-white">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</h5>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            

        <div class="section-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7 py-5 mt-lg-5 pr-lg-5">
                        <h1 class="text-white mb-4">Lorem Ispum</h1>
                        <p class="text-white">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>

                        <p class="text-white">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>.
                    
                        <p class="text-white">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>                    </div>
                    <div class="col-12 col-lg-5 text-center mt-4 mt-lg-0">
                        <h2 class="text-white mb-5">Mobile <b>Responsive</b></h2>
                            <img src="{{url('')}}/static/responsive.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 pr-lg-5">
                        <h2 class="text-white mb-3">Sakkhat</h2>
                        <p class="text-white text-white">Lorem ipsum, or lipsum as it is sometimes known, is dummy.</p>
                    </div>
                    <div class="col-12 col-lg-6 pt-4 pt-lg-0 px-lg-5">
                        <p class="text-white">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                    </div>
                </div>
            </div>
        </div>




</body>
</html>
