<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INCITRACK Admin Panel</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="icon" href="{{ asset('it.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
    @stack('styles')
</head>
<body>
    @if(Auth::check() && Auth::user()->role === 'admin')
        <div style="display: flex;">
            @include('components.admin-sidebar')
            <main class="mainContent">
                @yield('content')
            </main>
        </div>
    @else
        @yield('content')
    @endif

    @stack('scripts')
</body>
</html>
