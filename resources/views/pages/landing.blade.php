@extends('layouts.app')

@section('content')
<section class="landing-hero">
    <div class="container landing-header">
        <h1>Apa yang ingin Anda lakukan hari ini?</h1>
        <p class="subtitle">Pilih salah satu layanan utama kami di bawah ini untuk memulai akses sistem</p>

        <div class="landing-cards-grid">
            <a href="{{ route('lihat') }}" class="landing-action-card card-lihat">
                <div class="landing-card-icon">
                    <i class='bx bx-map'></i>
                </div>
                <h2>Mau Lihat Data Kecelakaan</h2>
                <p>Eksplorasi persebaran titik insiden lalu lintas dan riwayat titik rawan kecelakaan pada peta interaktif jalan tol nasional.</p>
                <div class="landing-card-arrow">
                    <span>Lihat Peta Sekarang</span>
                    <i class='bx bx-right-arrow-alt'></i>
                </div>
            </a>

            <a href="{{ route('lapor') }}" class="landing-action-card card-lapor">
                <div class="landing-card-icon">
                    <i class='bx bx-error-circle'></i>
                </div>
                <h2>Mau Lapor Kecelakaan</h2>
                <p>Laporkan insiden atau kecelakaan di ruas jalan tol dengan koordinat GPS akurat dan unggahan bukti untuk penanganan cepat.</p>
                <div class="landing-card-arrow">
                    <span>Buat Laporan Baru</span>
                    <i class='bx bx-right-arrow-alt'></i>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
