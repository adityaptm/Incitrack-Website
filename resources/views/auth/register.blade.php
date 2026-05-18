@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush


@section('content')
<div class="main">
    <div class="container gridContainer">
        <div class="mapSide">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d345121.3239918549!2d107.1701021881579!3d-6.632309707023505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1stol%20km92!5e0!3m2!1sid!2sid!4v1733208924468!5m2!1sid!2sid"
                width="100%" 
                height="100%" 
                style="border: 0; border-radius: var(--radius-lg);" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

        <div class="formSide">
            <div class="formBox">
                <div class="headerBox">
                    <h2>Daftar Akun</h2>
                    <p>Buat akun baru untuk mulai melaporkan</p>
                </div>

                @if($errors->any())
                    <div class="alert error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="nama"
                            placeholder="Nama Lengkap" 
                            value="{{ old('nama') }}"
                            required 
                        />
                    </div>
                    <div class="form-group">
                        <input 
                            type="email" 
                            name="email"
                            placeholder="Email" 
                            value="{{ old('email') }}"
                            required 
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
                        Daftar Sekarang
                    </button>
                </form>

                <p class="footerText">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
