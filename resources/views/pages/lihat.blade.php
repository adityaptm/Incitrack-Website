@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/lihat.css') }}">
@endpush


@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div class="main">
    <section class="heroSection">
        <h1>Lihat Laporan Kecelakaan</h1>
        <p>
            Temukan data kecelakaan lalu lintas dan lokasi rawan kecelakaan secara interaktif.
        </p>
    </section>

    <section class="mapSection">
        <div class="container">
            <form action="{{ route('lihat') }}" method="GET" class="searchContainer">
                <input 
                    type="text" 
                    name="search"
                    class="searchBar" 
                    placeholder="Cari berdasarkan lokasi, tanggal, atau jenis kecelakaan..."
                    value="{{ request('search') }}"
                />
                <button type="submit" class="btn btn-primary searchBtn">Cari</button>
            </form>

            <div class="mapContainer">
                <div id="map" style="height: 500px; width: 100%; border-radius: 10px; position: relative; z-index: 1;"></div>
            </div>

            <div class="tableContainer">
                <h2>Daftar Laporan Terverifikasi</h2>
                <div class="tableResponsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Jalan Tol</th>
                                <th>Lokasi</th>
                                <th>Jenis Kecelakaan</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporan as $l)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ $l->waktu }}</td>
                                    <td>{{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</td>
                                    <td>{{ $l->lokasi }}</td>
                                    <td>{{ $l->jenis }}</td>
                                    <td>
                                        @if($l->foto)
                                            <a href="{{ asset('uploads/'.$l->foto) }}" target="_blank" class="linkBukti">
                                                Lihat Foto
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="emptyState">Tidak ada data laporan ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const laporanList = @json($laporan);

    const map = L.map('map').setView([-0.789275, 113.921327], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    laporanList.forEach(l => {
        if (l.lat && l.lng) {
            const popupContent = `
                <strong>${l.jenis}</strong><br />
                ${l.lokasi}<br />
                Tgl: ${new Date(l.tanggal).toLocaleDateString('id-ID')}<br />
                ${l.jalan && l.jalan.nama_jalan ? `<span style="color: var(--primary-color)">Jalan: ${l.jalan.nama_jalan}</span>` : ''}
            `;
            L.marker([l.lat, l.lng]).addTo(map).bindPopup(popupContent);
        }
    });
});
</script>
@endpush
