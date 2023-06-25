

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{-- <meta name="description" content="{{get_setting('meta_description')}}"> --}}
<meta name="author" content="">

<title>ADMIN</title>

<!-- Custom fonts for this template-->

{{-- <link rel="shortcut icon" href="{{asset(get_setting('favicon'))}}"> --}}
<link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}} "  type="text/css"rel="stylesheet">

<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="{{asset('backend/bootstrap-4.6.2/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/bootstrap-4.6.2/css/bootstrap.min.css')}}">
{{-- font --}}
<link href="{{asset('backend/font/fontawesome-free-6.4.0/css/fontawesome.css')}}" rel="stylesheet">
<link href="{{asset('backend/font/fontawesome-free-6.4.0/css/brands.css')}}" rel="stylesheet">
<link href="{{asset('backend/font/fontawesome-free-6.4.0/css/solid.css')}}" rel="stylesheet">
<!-- Bootstrap switcha button-->
<link rel="stylesheet" href="{{asset('backend/switch-button-bootstrap/css/bootstrap-switch-button.css')}}">
<!-- Summernote -->
<link rel="stylesheet" href="{{asset('backend\summernote\summernote.css')}}">

@yield('head')