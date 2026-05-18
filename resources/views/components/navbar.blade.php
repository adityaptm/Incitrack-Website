<header class="header">
    <div class="container navContainer">
        <a href="{{ route('landing') }}" class="logo">
            <img src="{{ asset('it.png') }}" alt="INCITRACK" />
            <span>INCITRACK!</span>
        </a>

        <button class="menuToggle" onclick="document.getElementById('navContent').classList.toggle('open')">
            <i class="bx bx-menu"></i>
        </button>

        <div class="navContent" id="navContent">
            <nav class="navLinks">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                <a href="{{ route('lapor') }}" class="{{ request()->routeIs('lapor') ? 'active' : '' }}">Lapor</a>
                <a href="{{ route('lihat') }}" class="{{ request()->routeIs('lihat') ? 'active' : '' }}">Lihat</a>
            </nav>

            <div class="actions">
                @auth
                    <a href="{{ route('pengaturan') }}" class="userGreeting"><i class='bx bx-user-circle'></i><span>{{ Auth::user()->nama }}</span></a>
                    <button onclick="document.getElementById('logoutModal').classList.add('active')" class="btn btn-outline">Keluar</button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</header>

@auth
<div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
        <div style="font-size: 56px; color: var(--warning); margin-bottom: 8px;">
            <i class='bx bx-error-circle'></i>
        </div>
        <h3 style="margin-bottom: 8px; color: var(--secondary-color);">Konfirmasi Keluar</h3>
        <p style="color: var(--text-light); margin-bottom: 24px;">Apakah Anda yakin ingin keluar dari akun?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="document.getElementById('logoutModal').classList.remove('active')" class="btn" style="background: #eee; color: #333;">Tidak, Kembali</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Ya, Keluar</button>
            </form>
        </div>
    </div>
</div>
@endauth
