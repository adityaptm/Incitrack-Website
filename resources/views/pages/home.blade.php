@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush


@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container heroContainer">
        <div class="heroImage">
            <img src="{{ asset('it.png') }}" alt="INCITRACK Logo" />
        </div>
        <div class="heroText">
            <h1>Tentang INCITRACK</h1>
            <p>
                Platform visualisasi dan pelaporan kecelakaan lalu lintas secara real-time untuk meningkatkan keselamatan jalan tol di Indonesia.
            </p>
            <a href="{{ route('lapor') }}" class="btn btn-primary">Laporkan Sekarang</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container statsContainer">
        <div class="statItem">
            <h3>{{ number_format($stats['total_kecelakaan'], 0, ',', '.') }}</h3>
            <p>Total Kecelakaan Tahun Ini</p>
        </div>
        <div class="statItem">
            <h3>{{ number_format($stats['laporan_terverifikasi'], 0, ',', '.') }}</h3>
            <p>Laporan Terverifikasi</p>
        </div>
        <div class="statItem">
            <h3>{{ $stats['peningkatan_keselamatan'] }}%</h3>
            <p>Peningkatan Keselamatan</p>
        </div>
    </div>
</section>

<!-- Content Grid -->
<section class="contentGrid">
    <div class="container">
        <div class="textImageReverse">
            <p>Pelaporan yang akurat dapat membantu pemerintah memperbaiki titik rawan kecelakaan.</p>
            <div class="imagePlaceholder" style="background-image: url('{{ asset('image 6.png') }}')"></div>
        </div>
        <div class="textImage">
            <div class="imagePlaceholder" style="background-image: url('{{ asset('maps.jpg') }}')"></div>
            <p>Visualisasi data kami membantu memahami area berbahaya secara lebih mudah.</p>
        </div>
    </div>
</section>
@endsection
