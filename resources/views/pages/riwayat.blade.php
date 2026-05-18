@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pengaturan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/riwayat.css') }}">
@endpush


@section('content')
<div class="main">
    <div class="container gridContainer">
        <aside class="sidebarPengaturan">
            <h3 style="margin-bottom: 20px; color: var(--secondary-color);">Menu Akun</h3>
            <ul class="menuList">
                <li>
                    <a href="{{ route('pengaturan') }}" class="{{ request()->routeIs('pengaturan') ? 'active' : '' }}">
                        <i class='bx bx-user'></i> Profil
                    </a>
                </li>
                <li>
                    <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'active' : '' }}">
                        <i class='bx bx-history'></i> Riwayat Laporan
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" onclick="if(confirm('Yakin ingin keluar?')) this.closest('form').submit();" style="color: var(--danger);">
                            <i class='bx bx-log-out'></i> Keluar
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <section class="contentArea">
            <h2 style="margin-bottom: 24px; color: var(--secondary-color);">Riwayat Laporan Saya</h2>
            
            <div class="laporanList">
                @forelse($laporan as $l)
                    <div class="laporanCard">
                        <div class="cardHeader">
                            <div>
                                <h3>{{ $l->jenis }}</h3>
                                <span class="date"><i class='bx bx-calendar'></i> {{ \Carbon\Carbon::parse($l->tanggal)->format('d M Y') }}</span>
                            </div>
                            <span class="statusBadge {{ strtolower($l->status) }}">
                                {{ ucfirst($l->status) }}
                            </span>
                        </div>
                        <div class="cardBody">
                            <p><strong>Jalan Tol:</strong> {{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="emptyState">
                        <i class='bx bx-file-blank'></i>
                        <h3>Belum Ada Laporan</h3>
                        <p>Anda belum pernah membuat laporan kecelakaan.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
