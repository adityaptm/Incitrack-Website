@extends('layouts.app')

@section('content')
<div class="container user-layout-grid">
    <!-- User Sidebar Component -->
    @include('components.user-sidebar')

    <!-- Main Content Area -->
    <div class="card" style="padding: var(--space-5);">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: var(--space-4); border-bottom: 1px solid var(--border); padding-bottom: var(--space-2);">
            Pengaturan Profil
        </h2>

        @if(session('success'))
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-error">
                <i class='bx bx-error-circle'></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('pengaturan') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-user'></i>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        class="form-control" 
                        value="{{ old('nama', $user->nama) }}" 
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-envelope'></i>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        value="{{ old('email', $user->email) }}" 
                        required
                    >
                </div>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="password">Password Akun</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-lock-alt'></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control" 
                        placeholder="••••••••" 
                        disabled
                    >
                </div>
                <small class="help-text">
                    <i class='bx bx-info-circle' style="vertical-align: middle;"></i>
                    Password diamankan dan dinonaktifkan untuk perubahan langsung.
                </small>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 12px 28px;">
                <i class='bx bx-save'></i>
                <span>Simpan Perubahan</span>
            </button>
        </form>
    </div>
</div>
@endsection
