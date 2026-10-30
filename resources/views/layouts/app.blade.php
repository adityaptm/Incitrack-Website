<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INCITRACK - Pelacak & Pemantauan Insiden Jalan Tol Indonesia</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    
    <!-- Main Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/incitrack.css') }}">
    
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
