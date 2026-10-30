<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-header">
        <div class="logo-dark-container" style="padding: 4px;">
            <img src="{{ asset('images/logo.png') }}" alt="INCITRACK" style="height: 38px;">
        </div>
        <h2>INCITRACK</h2>
    </div>

    @php
        $namaParts = explode(' ', trim(Auth::user()->nama));
        $initials = '';
        foreach (array_slice($namaParts, 0, 2) as $p) {
            $initials .= strtoupper(substr($p, 0, 1));
        }
    @endphp

    <div class="admin-sidebar-user">
        <div class="admin-avatar-initials">{{ $initials }}</div>
        <div class="admin-sidebar-user-info">
            <strong>{{ Auth::user()->nama }}</strong>
            <span>Administrator</span>
        </div>
    </div>

    <ul class="admin-sidebar-nav">
        <li>
            <a href="{{ route('admin.home') }}" class="admin-sidebar-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <i class='bx bx-home'></i>
                <span>Beranda</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class='bx bx-grid-alt'></i>
                <span>Dashboard Data</span>
            </a>
        </li>
        <li style="margin-top: 24px;">
            <form action="{{ route('logout') }}" method="POST" id="adminSidebarLogoutForm">
                @csrf
                <button type="button" onclick="if(confirm('Apakah Anda yakin ingin keluar dari panel administrator?')) document.getElementById('adminSidebarLogoutForm').submit();" class="admin-sidebar-link danger">
                    <i class='bx bx-log-out'></i>
                    <span>Keluar</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
