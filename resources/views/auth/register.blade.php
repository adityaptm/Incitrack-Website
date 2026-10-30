@extends('layouts.app')

@section('content')
<div class="register-split-wrapper">
    <!-- Left Map View (60%) -->
    <div class="register-map-side">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d345121.3239918549!2d107.1701021881579!3d-6.632309707023505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1stol%20km92!5e0!3m2!1sid!2sid!4v1733208924468!5m2!1sid!2sid"
            style="width: 100%; height: 100%; border: none;" 
            allowfullscreen="" 
            loading="lazy"
            title="Peta Ruas Tol Cipularang">
        </iframe>
    </div>

    <!-- Right Form Card (40%) -->
    <div class="register-form-side">
        <div class="register-form-card">
            <div class="auth-logo-center">
                <img src="{{ asset('images/logo.png') }}" alt="INCITRACK">
            </div>

            <div class="auth-header">
                <h2>Daftar Akun</h2>
                <p>Buat akun baru untuk mulai melaporkan insiden jalan tol</p>
            </div>

            @if(isset($errors) && $errors->any())
                <div class="alert alert-error">
                    <i class='bx bx-error-circle'></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
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
                            placeholder="Contoh: Aditya Pratama" 
                            value="{{ old('nama') }}" 
                            required 
                            autofocus
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
                            placeholder="contoh@domain.com" 
                            value="{{ old('email') }}" 
                            required
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
                            placeholder="Minimal 6 karakter" 
                            required 
                            minlength="6"
                        >
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="padding: 13px; font-size: 15px;">
                    Daftar Sekarang
                </button>
            </form>

            <p class="auth-footer-text">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </p>
        </div>
    </div>
</div>
@endsection
