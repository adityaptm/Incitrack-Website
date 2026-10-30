@extends('layouts.admin')

@section('content')
<div style="margin-bottom: var(--space-4);">
    <h1 style="font-size: 26px; font-weight: 800; color: var(--navy); margin-bottom: 4px;">
        Selamat Datang Kembali, {{ Auth::user()->nama }}
    </h1>
    <p style="font-size: 14px; color: var(--muted);">
        Berikut ikhtisar metrik dan ringkasan data operasional sistem INCITRACK
    </p>
</div>

<!-- 6 Statistics Cards Grid -->
<div class="admin-stats-grid">
    <!-- 1. Total Pengguna (Biru #3498db) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #3498db;">
            <i class='bx bx-user'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['total_pengguna'] ?? 0, 0, ',', '.') }}</h3>
            <p>Total Pengguna</p>
        </div>
    </div>

    <!-- 2. Ruas Jalan Tol (Ungu #9b59b6) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #9b59b6;">
            <i class='bx bx-map-alt'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['total_jalan'] ?? 0, 0, ',', '.') }}</h3>
            <p>Ruas Jalan Tol</p>
        </div>
    </div>

    <!-- 3. Total Laporan (Merah #e74c3c) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #e74c3c;">
            <i class='bx bx-error-circle'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['total_laporan'] ?? 0, 0, ',', '.') }}</h3>
            <p>Total Laporan</p>
        </div>
    </div>

    <!-- 4. Menunggu Verifikasi (Oranye #f39c12) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #f39c12;">
            <i class='bx bx-time-five'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['laporan_pending'] ?? 0, 0, ',', '.') }}</h3>
            <p>Menunggu Verifikasi</p>
        </div>
    </div>

    <!-- 5. Laporan Valid (Hijau #27ae60) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #27ae60;">
            <i class='bx bx-check-circle'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['laporan_valid'] ?? 0, 0, ',', '.') }}</h3>
            <p>Laporan Valid</p>
        </div>
    </div>

    <!-- 6. Laporan Tidak Valid (Oranye #e67e22) -->
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #e67e22;">
            <i class='bx bx-x-circle'></i>
        </div>
        <div class="admin-stat-info">
            <h3>{{ number_format($stats['laporan_invalid'] ?? 0, 0, ',', '.') }}</h3>
            <p>Laporan Tidak Valid</p>
        </div>
    </div>
</div>

<!-- Laporan Terbaru Section -->
<div class="card" style="padding: var(--space-4);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-3);">
        <h2 style="font-size: 18px; font-weight: 700; color: var(--navy);">
            Laporan Terbaru Masuk
        </h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline" style="padding: 6px 14px; font-size: 13px;">
            <i class='bx bx-data'></i>
            <span>Kelola di Dashboard</span>
        </a>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Ruas Jalan</th>
                    <th>KM</th>
                    <th>Lokasi</th>
                    <th>Korban</th>
                    <th>Jenis Insiden</th>
                    <th>Pelapor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan_terbaru as $l)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($l['tanggal'])->format('d/m/Y') }}</td>
                        <td><strong>{{ $l['nama_jalan'] ?? '-' }}</strong></td>
                        <td><span style="color: var(--primary); font-weight: 700;">{{ $l['km'] ?? '-' }}</span></td>
                        <td>{{ $l['lokasi'] }}</td>
                        <td>{{ $l['jumlah_korban'] ?? 0 }} orang</td>
                        <td>{{ $l['jenis'] }}</td>
                        <td>{{ $l['pelapor'] ?? 'Anonim' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($l['status']) }}">
                                @if(strtolower($l['status']) === 'valid')
                                    Valid
                                @elseif(strtolower($l['status']) === 'invalid')
                                    Tidak Valid
                                @else
                                    Pending
                                @endif
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--muted); padding: 24px;">
                            Belum ada laporan insiden yang masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
