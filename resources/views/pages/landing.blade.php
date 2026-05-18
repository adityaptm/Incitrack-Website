@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush


@section('content')
<div class="main hero-section">
    <div class="container heroContainer">
        <h1>Apa yang ingin Anda lakukan hari ini?</h1>
        <p class="subtitle">Pilih salah satu opsi di bawah untuk melanjutkan</p>
        
        <div class="options">
            <a href="{{ route('lihat') }}" class="cardLihat">
                <div class="icon"><i class='bx bx-map-alt'></i></div>
                <h2>Mau Lihat Data Kecelakaan</h2>
                <p>Eksplorasi data kecelakaan dan lokasi rawan pada peta interaktif.</p>
            </a>
            
            <a href="{{ route('lapor') }}" class="cardLapor">
                <div class="icon"><i class='bx bx-error'></i></div>
                <h2>Mau Lapor Kecelakaan</h2>
                <p>Bantu kami catat dan laporkan insiden di jalan tol untuk keselamatan bersama.</p>
            </a>
        </div>
    </div>
</div>
@endsection
