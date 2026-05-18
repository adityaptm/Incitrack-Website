@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush


@section('content')
<div class="main">
    <div class="loginContainer">
        <div class="loginBox">
            <div class="headerBox">
                <img src="{{ asset('it.png') }}" alt="Logo" class="logo" />
                <h2>Masuk</h2>
                <p>Selamat Datang Kembali!</p>
            </div>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input 
                        type="email" 
                        name="email"
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    />
                </div>
                <div class="form-group">
                    <input 
                        type="password" 
                        name="password"
                        placeholder="Password" 
                        required 
                        minlength="6"
                    />
                </div>
                <button type="submit" class="btn btn-primary btnFull">
                    Masuk Sekarang
                </button>
            </form>

            <p class="footerText">
                Belum punya akun? <a href="{{ route('register') }}">Buat Akun</a>
            </p>
        </div>
    </div>
</div>
@endsection
