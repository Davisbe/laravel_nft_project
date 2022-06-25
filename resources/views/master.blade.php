<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
    </head>
    <body style="">

    <header id="header" class="">
        <div class="nav-spacer">
            <section class="nav-header">
                <div class="img-container">
                        <a href="{{ url('/') }}" title="Logo"><img src="{{ url('/images/logo.png') }}" alt="Logo" class="page-logo"></a>
                </div>

                <nav id="main-menu">
                    <ul>
                        <li class="main-button"><a href="{{ url('/') }}" title="">Sakums</a></li>
                        <li class="main-button"><a href="#rakstiAnchor" title="">test</a></li>
                        <li class="main-button"><a href="#jaunumiAnchor" title="">test</a></li>
                        <li class="main-button"><a href="" title="">testtest</a>
                            <ul class="sub-menu">
                                <li><button data-popup-target="#contact-popup" type="button">test</button></li>
                                <li><a href="" title="">test</a></li>
                            </ul>
                        <div class="icon collapse">&#9652;</div>
                        <div class="icon expand">&#9662;</div>
                        </li>
                    </ul>
                </nav>
            </section>

            <section class="auth">
                @if(Auth::check())
                <div class="log-div">
                    <a href="{{ url('profile/user/'.Auth::user()->id) }}" title="">Profile</a>
                </div>
                <div class="log-div">
                    <a href="{{ route('auth.logout') }}" title="">Log Out</a>
                </div>
                @else
                <div class="log-div">
                    <a href="{{ url('/auth/login') }}" title="">Login</a>
                </div>
                <div class="log-div">
                    <a href="{{ url('/auth/register') }}" title="">Sign Up</a>
                </div>
                @endif
            </section>
        </div>
    </header>

    <!-- Add your site or application content here -->
    <div class="page-wrapper">
        @yield('content')
    </div>
    
    <script language="JavaScript" type="text/javascript" src="{{ url('/js/main.js') }}"></script>
    </body>
</html>