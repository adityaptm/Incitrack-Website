<header class="navbar-header">
    <div class="container navbar-container" id="mainNavbar">
        <a href="{{ route('home') }}" class="brand-logo-wrap">
            <img src="{{ asset('images/logo.png') }}" alt="INCITRACK" class="brand-logo-img">
            <span class="brand-logo-text">INCITRACK</span>
        </a>

        <button class="navbar-toggle-btn" onclick="document.getElementById('mainNavbar').classList.toggle('mobile-open')">
            <i class="bx bx-menu"></i>
        </button>

        <nav class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            <a href="{{ route('lapor') }}" class="nav-link {{ request()->routeIs('lapor') ? 'active' : '' }}">Lapor</a>
            <a href="{{ route('lihat') }}" class="nav-link {{ request()->routeIs('lihat') ? 'active' : '' }}">Lihat</a>
        </nav>

        <div class="navbar-actions">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
            @else
                <div class="user-dropdown-wrap">
                    @php
                        $namaParts = explode(' ', trim(Auth::user()->nama));
                        $initials = '';
                        foreach (array_slice($namaParts, 0, 2) as $p) {
                            $initials .= strtoupper(substr($p, 0, 1));
                        }
                    @endphp
                    <button type="button" class="user-profile-btn" onclick="toggleUserDropdown(event)">
                        <div class="user-avatar-circle">{{ $initials }}</div>
                        <span>{{ Auth::user()->nama }}</span>
                        <i class='bx bx-chevron-down' style="font-size: 18px; color: var(--muted);"></i>
                    </button>

                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="{{ route('pengaturan') }}" class="user-dropdown-item">
                            <i class='bx bx-user'></i>
                            <span>Profil</span>
                        </a>
                        <a href="{{ route('riwayat') }}" class="user-dropdown-item">
                            <i class='bx bx-history'></i>
                            <span>Riwayat Laporan</span>
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <div class="user-dropdown-divider"></div>
                            <a href="{{ route('admin.home') }}" class="user-dropdown-item" style="color: var(--primary);">
                                <i class='bx bx-shield-quarter'></i>
                                <span>Panel Admin</span>
                            </a>
                        @endif
                        <div class="user-dropdown-divider"></div>
                        <button type="button" class="user-dropdown-item danger" onclick="openLogoutModal()">
                            <i class='bx bx-log-out'></i>
                            <span>Keluar</span>
                        </button>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>

@auth
<!-- Modal Konfirmasi Logout -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal-box" style="text-align: center;">
        <div style="font-size: 52px; color: var(--warning); margin-bottom: 8px;">
            <i class='bx bx-error-circle'></i>
        </div>
        <h3 style="color: var(--navy); margin-bottom: 8px;">Konfirmasi Keluar</h3>
        <p style="color: var(--muted); margin-bottom: 24px; font-size: 14px;">Apakah Anda yakin ingin mengakhiri sesi dan keluar dari akun?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button type="button" onclick="closeLogoutModal()" class="btn" style="background: #e2e8f0; color: #333;">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Ya, Keluar</button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleUserDropdown(e) {
    e.stopPropagation();
    const menu = document.getElementById('userDropdownMenu');
    if (menu) menu.classList.toggle('show');
}

function openLogoutModal() {
    const modal = document.getElementById('logoutModal');
    if (modal) modal.classList.add('active');
    const menu = document.getElementById('userDropdownMenu');
    if (menu) menu.classList.remove('show');
}

function closeLogoutModal() {
    const modal = document.getElementById('logoutModal');
    if (modal) modal.classList.remove('active');
}

window.addEventListener('click', function(e) {
    const menu = document.getElementById('userDropdownMenu');
    if (menu && !e.target.closest('.user-dropdown-wrap')) {
        menu.classList.remove('show');
    }
    const modal = document.getElementById('logoutModal');
    if (e.target === modal) {
        closeLogoutModal();
    }
});
</script>
@endauth
