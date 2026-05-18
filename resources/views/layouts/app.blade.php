<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INCITRACK! - Platform Pelaporan Kecelakaan</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="icon" href="{{ asset('it.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @stack('styles')
</head>
<body>
    <div class="page-wrapper">
        @include('components.navbar')
        
        <main>
            @yield('content')
        </main>
        
        @include('components.footer')
    </div>

    @stack('scripts')
</body>
</html>
