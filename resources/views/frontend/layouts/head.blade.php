    <meta charset="UTF-8">
    {{-- <meta name="description" content="{{get_setting('meta_description')}}">
    <meta name="keywords" content="{{get_setting('meta_keywords ')}}"> --}}

    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    {{-- <title>{{get_setting('title')}}</title> --}}

    <title>H-Shopping</title>

    <!-- Favicon  -->
    <link rel="shortcut icon" href="{{url('frontend/img/fav.png')}}">
    {{-- <link rel="shortcut icon" href="{{asset(get_setting('favicon'))}}"> --}}
   
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/classy-nav.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/icofont.min.css')}}">

    {{-- autoload --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    {{-- fonts --}}
    <link rel="stylesheet" href="{{asset('frontend/assets/fonts/icofont.woff')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/fonts/icofont.woff2')}}">
    <link href="{{asset('frontend/vendor/fontawesome-free-6.4.0/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/vendor/fontawesome-free-6.4.0/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/vendor/fontawesome-free-6.4.0/css/solid.css')}}" rel="stylesheet">
    @yield('head')