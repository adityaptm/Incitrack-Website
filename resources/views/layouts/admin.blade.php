<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INCITRACK Admin Panel - Pemantauan Insiden</title>
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
    @if(Auth::check() && Auth::user()->role === 'admin')
        <button class="admin-mobile-toggle" onclick="toggleAdminSidebar()">
            <i class='bx bx-menu'></i>
        </button>
        <div class="admin-overlay" id="adminOverlay" onclick="toggleAdminSidebar()"></div>

        <div class="admin-layout">
            @include('components.admin-sidebar')
            <main class="admin-main-content">
                @yield('content')
            </main>
        </div>
    @else
        @yield('content')
    @endif

    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminOverlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
