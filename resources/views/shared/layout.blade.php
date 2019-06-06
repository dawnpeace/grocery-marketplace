<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name') }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('shared.navbar')
    <div class="container">
        @yield('breadcrumb')
    </div>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>