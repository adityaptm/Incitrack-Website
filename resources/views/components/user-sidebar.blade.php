<aside class="user-sidebar-card">
    <h3 class="user-sidebar-title">Menu Akun</h3>
    <ul class="user-sidebar-menu">
        <li>
            <a href="{{ route('pengaturan') }}" class="user-sidebar-link {{ request()->routeIs('pengaturan') ? 'active' : '' }}">
                <i class='bx bx-user'></i>
                <span>Profil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('riwayat') }}" class="user-sidebar-link {{ request()->routeIs('riwayat') ? 'active' : '' }}">
                <i class='bx bx-history'></i>
                <span>Riwayat Laporan</span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST" id="userSidebarLogoutForm">
                @csrf
                <button type="button" onclick="if(confirm('Apakah Anda yakin ingin keluar dari akun?')) document.getElementById('userSidebarLogoutForm').submit();" class="user-sidebar-link danger" style="width: 100%; border: none; background: none; cursor: pointer;">
                    <i class='bx bx-log-out'></i>
                    <span>Keluar</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
