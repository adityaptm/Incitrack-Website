@extends('layouts.app')
@push('styles')
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
            
            <div class="tableResponsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jalan Tol</th>
                            <th>Jenis Kecelakaan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $l)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</td>
                                <td>{{ $l->jenis }}</td>
                                <td>
                                    <span class="badge {{ $l->status }}">
                                        {{ ucfirst($l->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="emptyState">Anda belum pernah membuat laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
