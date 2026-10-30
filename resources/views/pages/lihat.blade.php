@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<section class="red-header-banner">
    <div class="container">
        <h1>Lihat Laporan Kecelakaan</h1>
        <p>Temukan data kecelakaan lalu lintas dan lokasi rawan kecelakaan di jalan tol secara interaktif</p>
    </div>
</section>

<div class="container" style="padding-bottom: var(--space-8);">
    <!-- Floating Search Bar Card -->
    <div class="search-bar-card">
        <form action="{{ route('lihat') }}" method="GET" class="search-form-row">
            <input 
                type="text" 
                name="search" 
                class="search-input-field" 
                placeholder="Cari berdasarkan lokasi, KM, jenis, atau ruas jalan..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn btn-primary" style="padding: 0 28px;">
                <i class='bx bx-search'></i>
                <span>Cari</span>
            </button>
        </form>
    </div>

    <!-- Leaflet Map Container 500px -->
    <div class="lihat-map-container" id="lihatMap"></div>

    <!-- Data Table Section -->
    <div style="margin-top: var(--space-6);">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: var(--space-3);">
            Daftar Laporan Terverifikasi
        </h2>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jalan Tol</th>
                        <th>KM</th>
                        <th>Lokasi</th>
                        <th>Korban</th>
                        <th>Jenis Kecelakaan</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $l)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $l->waktu }}</td>
                            <td><strong>{{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</strong></td>
                            <td><span style="color: var(--primary); font-weight: 700;">{{ $l->km ?: '-' }}</span></td>
                            <td>{{ $l->lokasi }}</td>
                            <td>{{ $l->jumlah_korban ?? 0 }} orang</td>
                            <td>{{ $l->jenis }}</td>
                            <td>
                                @if($l->foto)
                                    <a href="{{ asset('uploads/'.$l->foto) }}" target="_blank" class="btn btn-outline" style="padding: 4px 10px; font-size: 12px;">
                                        <i class='bx bx-image'></i>
                                        <span>Lihat Foto</span>
                                    </a>
                                @else
                                    <span style="color: var(--muted);">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--muted); padding: 32px;">
                                <i class='bx bx-info-circle' style="font-size: 24px; vertical-align: middle; margin-right: 6px;"></i>
                                Tidak ada data laporan kecelakaan terverifikasi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const laporanList = @json($laporan);

    // Initial view of Indonesia
    const map = L.map('lihatMap').setView([-2.548926, 118.0148634], 5);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; Kontributor OpenStreetMap'
    }).addTo(map);

    let bounds = [];

    laporanList.forEach(l => {
        if (l.lat && l.lng) {
            const lat = parseFloat(l.lat);
            const lng = parseFloat(l.lng);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                bounds.push([lat, lng]);

                const popupContent = `
                    <div style="font-family: var(--font-sans); min-width: 180px;">
                        <strong style="color: #e74c3c; font-size: 14px; display: block; margin-bottom: 4px;">${l.jenis}</strong>
                        ${l.km ? '<span style="font-size: 12px; font-weight: 700; color: #2c3e50;">Lokasi: ' + l.km + '</span><br>' : ''}
                        <span style="font-size: 12px; color: #555;">${l.lokasi}</span><br>
                        <span style="font-size: 12px; color: #555;">Korban: <strong>${l.jumlah_korban ?? 0} orang</strong></span><br>
                        <span style="font-size: 11px; color: #888;">Tgl: ${new Date(l.tanggal).toLocaleDateString('id-ID')}</span><br>
                        ${l.jalan ? '<span style="font-size: 11px; color: #3498db; font-weight: 600;">' + l.jalan.nama_jalan + '</span>' : ''}
                    </div>
                `;
                L.marker([lat, lng]).addTo(map).bindPopup(popupContent);
            }
        }
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
    }
});
</script>
@endpush
