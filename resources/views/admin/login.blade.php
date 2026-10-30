@extends('layouts.admin')

@section('content')
<div class="admin-login-wrapper">
    <div class="admin-login-card">
        <div class="auth-logo-center">
            <img src="{{ asset('images/logo.png') }}" alt="INCITRACK">
        </div>

        <div style="margin-bottom: var(--space-4);">
            <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin-bottom: 4px;">
                Login Administrator
            </h2>
            <p style="font-size: 13px; color: var(--muted);">
                Akses terbatas pusat pengelolaan dan verifikasi insiden
            </p>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="alert alert-error" style="text-align: left;">
                <i class='bx bx-error-circle'></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email" style="display: none;">Email Admin</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-envelope'></i>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        placeholder="Email Admin" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="password" style="display: none;">Password</label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-lock-alt'></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control" 
                        placeholder="Password" 
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full" style="padding: 13px; font-size: 15px;">
                <i class='bx bx-log-in'></i>
                <span>Masuk</span>
            </button>

            <p style="font-size: 13px; color: var(--muted); margin-top: var(--space-4);">
                &copy; 2025 INCITRACK
            </p>
        </form>
    </div>
</div>
@endsection
