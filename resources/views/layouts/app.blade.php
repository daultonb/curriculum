<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}" ></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/UBC-logo-2018-crest-blue-rgb72-resized.png') }}" alt="UBC crest logo" style="margin-right: 25px">
                    <strong style="color: rgb(47, 93, 124); font-family: Arial, Helvetica, sans-serif">UBC Curriculum MAP</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" style="margin-left: 15px;">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item" style="margin-left: 15px;">
                            <a class="nav-link" href="{{ route('FAQ') }}">FAQ</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('home')}}">My Dashboard</a>
                        </li>

                        <li class="nav-item">

                        <!-- <a class="nav-link" href="{{ route('programs.index') }}">My Programs</a> -->
                        <a class="nav-link" href="/construction">My Programs</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">My Courses</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('syllabus') }}">Syllabus Generator</a>
                        </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    @can('admin-privilege')
                                        <a class="dropdown-item" href="{{ url('/admin') }}">
                                            System Administrator
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('requestInvitation') }}">
                                        Registration invite
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container bg-secondary">
            <main class="py-4">
                @include('partials.alerts')
                @yield('content')

            </main>
            
        </div>
        <!--
        <div class="ubc-footer-div">
        <style></style>
            <footer id="ubc7-footer" class="expand" role="contentinfo" >
                <div class="row-fluid expand" id="ubc7-unit-footer">
                    <div class="container">            
                        <div class="span10" id="ubc7-unit-address">
                            <div id="ubc7-address-unit-name">Office of the Provost and Vice-President Academic</div>
                            <div id="ubc7-address-campus">Okanagan Campus</div>                
                            <div id="ubc7-address-street">ADM119 - 1138 Alumni Ave</div>                                
                            <div id="ubc7-address-location">
                                <span id="ubc7-address-city">Kelowna</span>, 
                                <span id="ubc7-address-province">BC</span> 
                                <span id="ubc7-address-country">Canada</span> 
                                <span id="ubc7-address-postal">V1V 1V7</span> 
                            </div>
                            <div id="ubc7-address-website">Website <a href="http://provost.ok.ubc.ca"  target="_blank">provost.ok.ubc.ca</a></div>
                        </div>
                        <div class="span2">
                            <strong>Find us on</strong>
                            <div id="ubc7-unit-social-icons"><a href="https://twitter.com/ananyareed"  target="_blank" title="Twitter icon" target="_blank"><i class="icon-twitter-sign"></i></a>&nbsp;</div>
                        </div>            
                    </div>        
                </div>		
                
                <div class="row-fluid expand" id="ubc7-global-footer">
                    <div class="container">            
                        <div class="span5" id="ubc7-signature"><a href="http://www.ubc.ca/"  target="_blank" title="The University of British Columbia (UBC)">The University of British Columbia</a></div>
                        <div class="span7" id="ubc7-footer-menu">
                            <div class="row-fluid">
                                <div class="span6"><h3>About UBC</h3>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/contact" target="_blank">Contact UBC</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/about" target="_blank">About the University</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/news" target="_blank">News</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/events" target="_blank">Events</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/careers" target="_blank">Careers</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/gift" target="_blank">Make a Gift</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/search" target="_blank">Search UBC.ca</a></div>
                                </div>
                                <div class="span6"><h3>UBC Campuses</h3>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/vancouver" target="_blank">Vancouver Campus</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/okanagan" target="_blank">Okanagan Campus</a></div>
                                    <h4>UBC Sites</h4><div><a href="https://cdn.ubc.ca/clf/ref/robson" target="_blank">Robson Square</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/centre-for-digital-media" target="_blank">Centre for Digital Media</a></div>
                                    <div><a href="https://cdn.ubc.ca/clf/ref/medicine" target="_blank">Faculty of Medicine Across BC</a></div>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="row-fluid expand" id="ubc7-minimal-footer">
                    <div class="container">            
                        <div class="span12">
                            <ul>
                                <li><a href="//cdn.ubc.ca/clf/ref/emergency" title="Emergency Procedures">Emergency Procedures</a> <span class="divider">|</span></li>
                                <li><a href="//cdn.ubc.ca/clf/ref/terms" title="Terms of Use">Terms of Use</a> <span class="divider">|</span></li>
                                <li><a href="//cdn.ubc.ca/clf/ref/copyright" title="UBC Copyright">Copyright</a> <span class="divider">|</span></li>
                                <li><a href="//cdn.ubc.ca/clf/ref/accessibility" title="Accessibility">Accessibility</a></li>
                            </ul>
                        </div>
                    </div>        
                </div>
            </footer>
        </div>
        -->
        <div style="width:100%;">
            <iframe src="{{ asset('footer.html') }}" width="100%" scrolling="no" style="border:none; margin-bottom:-20px; min-height:426px; max-height: 821px;"/>
        </div>
        
        
    </div>

</body>
</html>
