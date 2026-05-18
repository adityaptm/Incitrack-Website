@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-home.css') }}">
@endpush

@section('content')
<div class="headerDashboard">
    <h1>Selamat Datang Kembali, <strong>{{ Auth::user()->nama }}</strong> <i class='bx bx-smile' style='color: #f1c40f'></i></h1>
    <p>Berikut ringkasan aktivitas platform INCITRACK hari ini</p>
</div>

<div class="statsGrid">
    <div class="statCard">
        <div class="statIcon" style="background: #3498db"><i class='bx bxs-user-detail'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['total_pengguna'] }}</h3>
            <p>Total Pengguna</p>
        </div>
    </div>
    <div class="statCard">
        <div class="statIcon" style="background: #9b59b6"><i class='bx bxs-map-alt'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['total_jalan'] }}</h3>
            <p>Ruas Jalan Tol</p>
        </div>
    </div>
    <div class="statCard">
        <div class="statIcon" style="background: #e74c3c"><i class='bx bxs-error'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['total_laporan'] }}</h3>
            <p>Total Laporan</p>
        </div>
    </div>
    <div class="statCard">
        <div class="statIcon" style="background: #f39c12"><i class='bx bx-time-five'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['laporan_pending'] }}</h3>
            <p>Menunggu Verifikasi</p>
        </div>
    </div>
    <div class="statCard">
        <div class="statIcon" style="background: #27ae60"><i class='bx bx-check-circle'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['laporan_valid'] }}</h3>
            <p>Laporan Valid</p>
        </div>
    </div>
    <div class="statCard">
        <div class="statIcon" style="background: #e67e22"><i class='bx bx-x-circle'></i></div>
        <div class="statInfo">
            <h3>{{ $stats['laporan_invalid'] }}</h3>
            <p>Laporan Tidak Valid</p>
        </div>
    </div>
</div>

<section class="recentReports">
    <h2>Laporan Kecelakaan Terbaru</h2>
    <div class="tableWrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Ruas Jalan</th>
                    <th>Lokasi</th>
                    <th>Jenis</th>
                    <th>Pelapor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan_terbaru as $l)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($l['tanggal'])->format('d/m/Y') }}</td>
                    <td>{{ $l['nama_jalan'] ?? '-' }}</td>
                    <td>{{ $l['lokasi'] }}</td>
                    <td>{{ $l['jenis'] }}</td>
                    <td>{{ $l['pelapor'] ?? 'Anonim' }}</td>
                    <td>
                        <span class="badge {{ $l['status'] }}">
                            {{ $l['status'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
