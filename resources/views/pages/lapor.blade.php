@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<section class="red-header-banner">
    <div class="container">
        <h1>Laporkan Kecelakaan Jalan Tol</h1>
        <p>Bantu tingkatkan keselamatan dan percepat respons darurat dengan laporan akurat Anda</p>
    </div>
</section>

<div class="container floating-form-wrapper">
    <div class="floating-form-card">
        @if(isset($errors) && $errors->any())
            <div class="alert alert-error">
                <i class='bx bx-error-circle'></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i>
                <div>
                    <strong style="display: block; font-size: 15px;">Laporan Berhasil Terkirim!</strong>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('lapor') }}" enctype="multipart/form-data" id="formLapor">
            @csrf

            @php
                $now = \Carbon\Carbon::now('Asia/Jakarta');
                $tanggalSekarang = $now->format('Y-m-d');
                $hour = (int)$now->format('H');
                if ($hour >= 0 && $hour < 11) {
                    $keterangan = 'Pagi';
                } elseif ($hour >= 11 && $hour < 15) {
                    $keterangan = 'Siang';
                } elseif ($hour >= 15 && $hour < 18) {
                    $keterangan = 'Sore';
                } else {
                    $keterangan = 'Malam';
                }
                $waktuSekarang = $now->format('H:i') . ' ' . $keterangan;
            @endphp

            <div class="form-grid">
                <div class="form-group">
                    <label>Tanggal Kejadian <span class="required">*</span></label>
                    <input type="date" name="tanggal" value="{{ $tanggalSekarang }}" readonly required>
                </div>
                <div class="form-group">
                    <label>Waktu Kejadian <span class="required">*</span></label>
                    <input type="text" name="waktu" value="{{ $waktuSekarang }}" readonly required>
                </div>
            </div>

            <div class="form-group">
                <label for="jalan_id">Ruas Jalan Tol <span class="required">*</span></label>
                <select name="jalan_id" id="jalan_id" required>
                    <option value="" disabled selected>-- Pilih Ruas Jalan Tol --</option>
                    @foreach($jalanList as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jalan }} - {{ $j->kota }} ({{ $j->panjang }} km)</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="km">Lokasi Kilometer (KM) <span class="required">*</span></label>
                    <input type="text" name="km" id="km" placeholder="Contoh: KM 92 B atau KM 120" value="{{ old('km') }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_korban">Jumlah Korban <span class="required">*</span></label>
                    <input type="number" name="jumlah_korban" id="jumlah_korban" min="0" value="{{ old('jumlah_korban', 0) }}" placeholder="0 jika tidak ada korban" required>
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Detail Kejadian <span class="required">*</span></label>
                <input type="text" name="lokasi" id="lokasi" placeholder="Contoh: Lajur kanan setelah rest area arah Jakarta" value="{{ old('lokasi') }}" required>
            </div>

            <div class="form-group">
                <label>Titik Koordinat (Satelit GPS) <span class="required">*</span></label>
                <div class="gps-status-box" id="gpsStatusBox">
                    <i class='bx bx-loader-alt bx-spin' id="gpsIcon"></i>
                    <span id="gpsText">Mendeteksi lokasi satelit GPS otomatis...</span>
                </div>

                <input type="hidden" name="lat" id="latInput" value="{{ old('lat') }}">
                <input type="hidden" name="lng" id="lngInput" value="{{ old('lng') }}">

                <div id="map" class="form-map-preview" style="display: none;"></div>
            </div>

            <div class="form-group">
                <label for="jenis">Jenis Kecelakaan <span class="required">*</span></label>
                <input type="text" name="jenis" id="jenis" placeholder="Contoh: Tabrakan Beruntun, Mobil Terguling, Pecah Ban" value="{{ old('jenis') }}" required>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="penyebab">Penyebab Insiden (Opsional)</label>
                    <input type="text" name="penyebab" id="penyebab" placeholder="Contoh: Pengemudi Mengantuk, Jalan Licin" value="{{ old('penyebab') }}">
                </div>
                <div class="form-group">
                    <label for="dampak">Dampak Lalu Lintas (Opsional)</label>
                    <input type="text" name="dampak" id="dampak" placeholder="Contoh: Macet 2 km, Lajur 1 & 2 Tertutup" value="{{ old('dampak') }}">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="foto">Foto Bukti Kejadian <span class="required">*</span></label>
                    <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/gif" required>
                    <small class="help-text">Format didukung: JPG, PNG, GIF. Maksimal 5MB.</small>
                </div>
                <div class="form-group">
                    <label for="video">Video Bukti Kejadian (Opsional)</label>
                    <input type="file" name="video" id="video" accept="video/mp4,video/quicktime,video/x-msvideo">
                    <small class="help-text">Format didukung: MP4, MOV, AVI. Maksimal 50MB.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full" id="btnSubmit" style="padding: 14px; font-size: 16px; margin-top: var(--space-2);" disabled>
                <i class='bx bx-send'></i>
                <span>Kirim Laporan</span>
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gpsStatusBox = document.getElementById('gpsStatusBox');
    const gpsIcon = document.getElementById('gpsIcon');
    const gpsText = document.getElementById('gpsText');
    const btnSubmit = document.getElementById('btnSubmit');
    const latInput = document.getElementById('latInput');
    const lngInput = document.getElementById('lngInput');
    const mapDiv = document.getElementById('map');
    
    let map = null;
    let marker = null;

    function initMap(lat, lng) {
        latInput.value = lat;
        lngInput.value = lng;
        btnSubmit.disabled = false;
        mapDiv.style.display = 'block';
        
        if (map) {
            map.setView([lat, lng], 15);
            if (marker) {
                marker.setLatLng([lat, lng]);
            }
        } else {
            map = L.map('map', { 
                zoomControl: true, 
                scrollWheelZoom: true, 
                dragging: true 
            }).setView([lat, lng], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; Kontributor OpenStreetMap'
            }).addTo(map);
            
            marker = L.marker([lat, lng], { draggable: false }).addTo(map);
        }
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                gpsStatusBox.className = 'gps-status-box success';
                gpsIcon.className = 'bx bx-check-circle';
                gpsText.textContent = 'Lokasi GPS Anda berhasil dideteksi dan dikunci otomatis (' + lat.toFixed(4) + ', ' + lng.toFixed(4) + ').';
                
                initMap(lat, lng);
            },
            function(err) {
                gpsStatusBox.className = 'gps-status-box success';
                gpsIcon.className = 'bx bx-map-pin';
                gpsText.textContent = 'Menggunakan koordinat default ruas tol Jakarta (-6.2088, 106.8456).';
                initMap(-6.2088, 106.8456);
            },
            { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
        );
    } else {
        gpsStatusBox.className = 'gps-status-box success';
        gpsIcon.className = 'bx bx-map-pin';
        gpsText.textContent = 'Menggunakan koordinat default ruas tol Jakarta (-6.2088, 106.8456).';
        initMap(-6.2088, 106.8456);
    }

    document.getElementById('formLapor').addEventListener('submit', function(e) {
        if (!latInput.value) {
            e.preventDefault();
            alert('Menunggu titik koordinat GPS. Pastikan izin lokasi aktif.');
            return;
        }
        if (!confirm('Apakah Anda yakin data laporan insiden sudah lengkap dan benar?')) {
            e.preventDefault();
        } else {
            btnSubmit.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Mengirim Laporan...";
            btnSubmit.disabled = true;
        }
    });
});
</script>
@endpush
