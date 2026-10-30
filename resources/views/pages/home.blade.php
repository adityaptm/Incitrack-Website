@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="home-hero-section">
    <div class="container home-hero-grid">
        <div class="home-hero-image-wrap">
            <img src="{{ asset('images/logo.png') }}" alt="INCITRACK Logo" class="home-hero-logo">
        </div>
        <div class="home-hero-content">
            <h1>Tentang INCITRACK</h1>
            <p>
                Platform pemantauan, visualisasi, dan pencatatan insiden kecelakaan jalan tol nasional secara terintegrasi. Kami menghubungkan pengguna jalan dengan pengelola tol untuk mempercepat respons penanganan dan meningkatkan keselamatan transportasi darat.
            </p>
            <a href="{{ route('lapor') }}" class="btn btn-primary" style="padding: 14px 28px; font-size: 16px;">
                <i class='bx bx-plus-circle'></i>
                <span>Laporkan Sekarang</span>
            </a>
        </div>
    </div>
</section>

<!-- Statistics Strip (Navy Full Width) -->
<section class="stats-strip">
    <div class="container stats-grid">
        <div class="stats-item">
            <h3>{{ number_format($stats['total_kecelakaan'] ?? 0, 0, ',', '.') }}</h3>
            <p>Total Kecelakaan Terdata</p>
        </div>
        <div class="stats-item">
            <h3>{{ number_format($stats['laporan_terverifikasi'] ?? 0, 0, ',', '.') }}</h3>
            <p>Laporan Terverifikasi Petugas</p>
        </div>
        <div class="stats-item">
            <h3>{{ $stats['peningkatan_keselamatan'] ?? 0 }}%</h3>
            <p>Tingkat Validitas & Tanggap Darurat</p>
        </div>
    </div>
</section>

<!-- Feature Showcase Sections (Alternating) -->
<section class="home-features-section">
    <div class="container">
        <!-- Feature 1: Image Left, Text Right -->
        <div class="feature-row">
            <div class="feature-box-visual">
                <i class='bx bx-line-chart'></i>
                <h3 style="font-size: 18px; font-weight: 700; color: var(--navy);">Analisis Titik Rawan</h3>
                <p style="font-size: 13px; color: var(--muted); max-width: 280px; margin-top: 4px;">Pemetaan algoritma untuk mendeteksi area rawan insiden di sepanjang kilometer tol.</p>
            </div>
            <div class="feature-text-content">
                <h2>Pelaporan Cepat Berbasis Koordinat GPS</h2>
                <p>
                    Setiap laporan insiden yang masuk divalidasi dengan titik koordinat satelit GPS secara otomatis. Hal ini memastikan petugas derek, ambulans, dan patroli jalan tol dapat menemukan lokasi kejadian secara presisi tanpa hambatan komunikasi.
                </p>
            </div>
        </div>

        <!-- Feature 2: Text Left, Image Right -->
        <div class="feature-row">
            <div class="feature-text-content">
                <h2>Transparansi Data & Visualisasi Interaktif</h2>
                <p>
                    Data kecelakaan terverifikasi disajikan dalam bentuk peta digital interaktif yang dapat diakses publik. Pengguna jalan tol dapat merencanakan perjalanan dengan lebih waspada pada titik-titik kilometer yang teridentifikasi rawan insiden.
                </p>
            </div>
            <div class="feature-box-visual">
                <i class='bx bx-map-pin'></i>
                <h3 style="font-size: 18px; font-weight: 700; color: var(--navy);">Peta Interaktif Nasional</h3>
                <p style="font-size: 13px; color: var(--muted); max-width: 280px; margin-top: 4px;">Informasi spasial terperinci di seluruh ruas jalan tol di pulau Jawa, Sumatera, hingga Bali.</p>
            </div>
        </div>
    </div>
</section>
@endsection
