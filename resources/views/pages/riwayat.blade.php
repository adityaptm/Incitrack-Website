@extends('layouts.app')

@section('content')
<div class="container user-layout-grid">
    <!-- User Sidebar Component -->
    @include('components.user-sidebar')

    <!-- Main Content Area -->
    <div class="card" style="padding: var(--space-5);">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: var(--space-4); border-bottom: 1px solid var(--border); padding-bottom: var(--space-2);">
            Riwayat Laporan Saya
        </h2>

        <div class="reports-stack-list">
            @forelse($laporan as $l)
                <div class="report-card-item">
                    <div class="report-card-header">
                        <div>
                            <h3>{{ $l->jenis }}</h3>
                            <div class="report-card-meta">
                                <i class='bx bx-calendar'></i>
                                <span>{{ \Carbon\Carbon::parse($l->tanggal)->format('d F Y') }} &bull; {{ $l->waktu }}</span>
                            </div>
                        </div>
                        <span class="badge badge-{{ strtolower($l->status) }}">
                            @if(strtolower($l->status) === 'valid')
                                Terverifikasi
                            @elseif(strtolower($l->status) === 'invalid')
                                Ditolak
                            @else
                                Menunggu
                            @endif
                        </span>
                    </div>

                    <div class="report-card-body">
                        <p style="color: var(--muted); font-size: 14px; margin-bottom: 6px;">
                            <strong>Ruas Tol:</strong> {{ $l->jalan ? $l->jalan->nama_jalan : '-' }}
                            @if($l->km)
                                &bull; <strong style="color: var(--primary);">{{ $l->km }}</strong>
                            @endif
                        </p>
                        <p style="font-size: 13px; color: var(--text);">
                            <strong>Detail Lokasi:</strong> {{ $l->lokasi }}
                        </p>
                        @if($l->penyebab)
                            <p style="font-size: 13px; color: var(--muted); margin-top: 4px;">
                                <strong>Penyebab:</strong> {{ $l->penyebab }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state-box">
                    <i class='bx bx-file'></i>
                    <h3>Belum Ada Laporan</h3>
                    <p>Anda belum pernah mengirimkan laporan insiden kecelakaan lalu lintas jalan tol.</p>
                    <a href="{{ route('lapor') }}" class="btn btn-primary">
                        <i class='bx bx-plus'></i>
                        <span>Mulai Laporkan Kecelakaan</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
