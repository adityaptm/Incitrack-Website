@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
@endpush

@section('content')
<div class="loginContainer">
    <form class="loginBox" method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="header">
            <img src="{{ asset('it.png') }}" alt="Logo" class="logo" />
            <h2>Login Admin</h2>
            <p>Masuk ke Dashboard Administrator</p>
        </div>

        @if($errors->any())
            <div class="alert error" style="background: #fdf2f2; color: var(--danger); padding: 10px; border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="form-group" style="margin-bottom: 15px;">
            <input 
                type="email" 
                name="email"
                placeholder="Email Admin" 
                value="{{ old('email') }}"
                required 
                style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-sm);"
            />
        </div>
        <div class="form-group" style="margin-bottom: 20px;">
            <input 
                type="password" 
                name="password"
                placeholder="Password" 
                required 
                style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-sm);"
            />
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 600; cursor: pointer;">
            Masuk
        </button>

        <p class="footer">INCITRACK Admin Panel © {{ date('Y') }}</p>
    </form>
</div>
@endsection
