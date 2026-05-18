@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/lapor.css') }}">
@endpush


@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div class="main">
    <section class="laporHeader">
        <h1>Laporkan Kecelakaan Jalan Tol</h1>
        <p>Bantu kami tingkatkan keselamatan jalan dengan laporan Anda</p>
    </section>

    <div class="container">
        <div class="laporFormContainer">
            @if($errors->any())
                <div class="alertBoxError">
                    <i class='bx bx-error'></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alertBoxSuccess">
                    <i class='bx bx-check-shield'></i>
                    <div>
                        <strong style="display: block; font-size: 18px; margin-bottom: 4px;">Laporan Terkirim!</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('lapor') }}" enctype="multipart/form-data" class="laporForm" id="formLapor">
                @csrf
                <div class="formGrid">
                    @php
                        // Gunakan zona waktu Indonesia (WIB)
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
                    <div class="form-group">
                        <label>Tanggal Kejadian <span class="required">*</span></label>
                        <input type="date" name="tanggal" required value="{{ $tanggalSekarang }}" readonly style="background-color: #f1f2f6; color: #7f8c8d; cursor: not-allowed;" />
                    </div>
                    <div class="form-group">
                        <label>Waktu <span class="required">*</span></label>
                        <input type="text" name="waktu" required value="{{ $waktuSekarang }}" readonly style="background-color: #f1f2f6; color: #7f8c8d; cursor: not-allowed;" />
                    </div>
                </div>

                <div class="form-group">
                    <label>Ruas Jalan Tol <span class="required">*</span></label>
                    <select name="jalan_id" required>
                        <option value="" disabled selected>Pilih jalan tol</option>
                        @foreach($jalanList as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalan }} - {{ $j->kota }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lokasi Detail Kejadian <span class="required">*</span></label>
                    <input type="text" name="lokasi" placeholder="Contoh: Lajur kanan setelah rest area" required />
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label>Titik Koordinat <span class="required">*</span></label>
                    <div class="gpsStatus" id="gpsStatusBox">
                        <i class='bx bx-loader-alt bx-spin' id="gpsIcon"></i>
                        <span id="gpsText">Mencari lokasi (GPS) otomatis...</span>
                    </div>
                    
                    <input type="hidden" name="lat" id="latInput" />
                    <input type="hidden" name="lng" id="lngInput" />
                    
                    <div id="map" style="height: 300px; width: 100%; border-radius: 10px; border: 1.5px solid var(--border-color); display: none;"></div>
                </div>

                <div class="form-group">
                    <label>Jenis Kecelakaan <span class="required">*</span></label>
                    <input type="text" name="jenis" placeholder="Contoh: Tabrakan beruntun" required />
                </div>

                <div class="form-group">
                    <label>Penyebab (Opsional)</label>
                    <input type="text" name="penyebab" placeholder="Mengantuk, rem blong, dll" />
                </div>

                <div class="form-group">
                    <label>Dampak (Opsional)</label>
                    <input type="text" name="dampak" placeholder="2 luka berat, 1 meninggal, dll" />
                </div>

                <div class="form-group">
                    <label>Foto Bukti <span class="required">*</span></label>
                    <input type="file" name="foto" accept="image/jpeg, image/png, image/gif" required />
                    <small class="helpText">Max 5MB. Format: JPG, PNG, GIF</small>
                </div>

                <div class="form-group">
                    <label>Video Bukti (Opsional)</label>
                    <input type="file" name="video" accept="video/mp4, video/quicktime, video/x-msvideo" />
                    <small class="helpText">Max 50MB. Format: MP4, MOV, AVI</small>
                </div>

                <button type="submit" class="btn btn-primary btnSubmit" id="btnSubmit" disabled>
                    Kirim Laporan
                </button>
            </form>
        </div>
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
            // Leaflet Map Initialization
            map = L.map('map', { 
                zoomControl: true, 
                scrollWheelZoom: true, 
                dragging: true 
            }).setView([lat, lng], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Marker is fixed to the detected location to prevent fake reports
            marker = L.marker([lat, lng], { draggable: false }).addTo(map);
        }
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                gpsStatusBox.className = 'gpsStatus success';
                gpsIcon.className = 'bx bx-check-circle';
                gpsText.textContent = 'Lokasi GPS Anda berhasil dideteksi dan dikunci otomatis.';
                
                initMap(lat, lng);
            },
            function(err) {
                console.error(err);
                gpsStatusBox.className = 'gpsStatus success';
                gpsIcon.className = 'bx bx-map-pin';
                gpsText.innerHTML = '<strong>Akses Lokasi Ditolak:</strong> Anda tidak dapat membuat laporan tanpa menyalakan lokasi GPS (GPS Wajib).';
                
                // Fallback coordinates: Jakarta (-6.2088, 106.8456)
                initMap(-6.2088, 106.8456);
            },
            { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
        );
    } else {
        gpsStatusBox.className = 'gpsStatus success';
        gpsIcon.className = 'bx bx-map-pin';
        gpsText.innerHTML = '<strong>Akses Lokasi Ditolak:</strong> Anda tidak dapat membuat laporan tanpa menyalakan lokasi GPS (GPS Wajib).';
        
        // Fallback coordinates: Jakarta (-6.2088, 106.8456)
        initMap(-6.2088, 106.8456);
    }

    document.getElementById('formLapor').addEventListener('submit', function(e) {
        if (!latInput.value) {
            e.preventDefault();
            alert('Menunggu titik lokasi GPS Anda. Pastikan Anda mengizinkan akses lokasi.');
            window.scrollTo(0, 0);
            return;
        }
        if (!confirm('Apakah kamu yakin ingin mengirim laporan ini? Cek terlebih dahulu data dan titik lokasi Anda.')) {
            e.preventDefault();
        } else {
            btnSubmit.innerHTML = '<span class="loader"></span>';
            btnSubmit.disabled = true;
        }
    });
});
</script>
@endpush
