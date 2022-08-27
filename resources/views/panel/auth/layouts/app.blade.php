<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
    .login-page {
        background-size: cover;
        background-repeat: no-repeat;
        background-image: url('https://media.istockphoto.com/photos/abstract-futuristic-with-connection-lines-on-blue-background-plexus-picture-id1285395672?b=1&k=20&m=1285395672&s=170667a&w=0&h=Wkn9h7EjOTLAAG8zSoTcnvrDrtFjTOPryJeIOBlD3r4=');
    }
    .login-logo a{
        color:white;
    }
    .register-logo a{
        color:white;
    }
</style>
<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>
    {{-- Javascript starts from here --}}
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.js') }}"></script>
    @yield('scripts')
</body>
</html>
