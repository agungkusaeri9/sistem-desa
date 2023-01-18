<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    @vite(['resources/js/app.js'])
</head>
<body>

    {{-- navbar --}}
    <x-Frontend.Navbar></x-Frontend.Navbar>
    {{-- akhir navbar --}}

    {{-- content --}}
    <div style="margin-top: 100px">
        @yield('content')
    </div>
    {{-- end content --}}

    <script src="{{ asset('assets/frontend/js/jquery-3.6.1.min.js') }}"></script>
</body>
</html>
