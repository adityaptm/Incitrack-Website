<button class="mobileToggle" onclick="document.getElementById('adminSidebar').classList.toggle('open'); document.getElementById('sidebarOverlay').style.display='block';">
    <i class='bx bx-menu'></i>
</button>

<div class="overlay" id="sidebarOverlay" onclick="document.getElementById('adminSidebar').classList.remove('open'); this.style.display='none';"></div>

<aside class="sidebar" id="adminSidebar">
    <div class="logoSidebar">
        <img src="{{ asset('it.png') }}" alt="INCITRACK" />
        <h2>INCITRACK</h2>
    </div>
    <div class="userInfo">
        <div class="avatar"><i class='bx bx-user'></i></div>
        <p>{{ Auth::user()->nama }}</p>
    </div>
    <nav class="nav">
        <ul>
            <li>
                <a href="{{ route('admin.home') }}" class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
                    <i class='bx bx-home' style="font-size: 20px;"></i> Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class='bx bx-data' style="font-size: 20px;"></i> Dashboard
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <a href="#" onclick="if(confirm('Yakin ingin keluar?')) document.getElementById('logoutForm').submit();" class="logoutBtn">
                        <i class='bx bx-log-out' style="font-size: 20px;"></i> Logout
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</aside>
