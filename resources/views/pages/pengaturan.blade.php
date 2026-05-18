@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pengaturan.css') }}">
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
            <h2 style="margin-bottom: 24px; color: var(--secondary-color);">Pengaturan Profil</h2>
            
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('pengaturan') }}" class="formBox">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required />
                </div>
                <div class="form-group">
                    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" placeholder="••••••••" disabled />
                    <small>Ubah password sedang dinonaktifkan pada versi ini.</small>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </section>
    </div>
</div>
@endsection
