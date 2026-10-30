@extends('layouts.app')

@section('content')
<div class="auth-page-wrapper">
    <div class="auth-card-centered">
        <div class="auth-logo-center">
            <img src="{{ asset('images/logo.png') }}" alt="INCITRACK">
        </div>

        <div class="auth-header">
            <h2>Masuk</h2>
            <p>Selamat Datang Kembali! Silakan login ke akun Anda</p>
        </div>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-envelope'></i>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        placeholder="contoh@domain.com" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="password">Password</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-lock-alt'></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control" 
                        placeholder="Masukkan password Anda" 
                        required 
                        minlength="6"
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-gradient-primary btn-full">
                Masuk Sekarang
            </button>
        </form>

        <p class="auth-footer-text">
            Belum punya akun? <a href="{{ route('register') }}">Buat Akun</a>
        </p>
    </div>
</div>
@endsection
