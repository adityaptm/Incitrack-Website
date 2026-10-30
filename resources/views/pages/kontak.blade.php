@extends('layouts.app')

@section('content')
<!-- Navy Gradient Header with Wave bottom edge (clip-path) -->
<section class="kontak-wave-header">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p style="color: #ecf0f1; font-size: 16px;">Pusat layanan informasi, bantuan darurat, dan pengaduan insiden jalan tol nasional</p>
    </div>
</section>

<!-- Two Columns overlapping the header -->
<div class="container kontak-grid">
    <!-- Left Column: Contact Details Card -->
    <div class="card" style="padding: var(--space-5);">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: 8px;">
            Kantor Layanan Terpadu
        </h2>
        <p style="color: var(--muted); font-size: 14px; margin-bottom: var(--space-4); line-height: 1.6;">
            Tim teknis dan call center kami siaga 24 jam untuk melayani pertanyaan, verifikasi lapangan, dan koordinasi pertolongan pertama di jalan tol.
        </p>

        <div class="contact-card-item">
            <div class="contact-card-icon">
                <i class='bx bx-map-pin'></i>
            </div>
            <div>
                <strong style="display: block; font-size: 14px; color: var(--navy);">Alamat Kantor Pusat</strong>
                <p style="font-size: 13px; color: var(--muted); margin-top: 2px;">Jl. Senayan No. 3, Tower C Lantai 8, Jakarta Pusat, DKI Jakarta 10270</p>
            </div>
        </div>

        <div class="contact-card-item">
            <div class="contact-card-icon">
                <i class='bx bx-phone'></i>
            </div>
            <div>
                <strong style="display: block; font-size: 14px; color: var(--navy);">Telepon Layanan Darurat</strong>
                <p style="font-size: 13px; color: var(--muted); margin-top: 2px;">021 - 1234 - 5678 (24 Jam Bebas Pulsa)</p>
            </div>
        </div>

        <div class="contact-card-item">
            <div class="contact-card-icon">
                <i class='bx bxl-whatsapp'></i>
            </div>
            <div>
                <strong style="display: block; font-size: 14px; color: var(--navy);">WhatsApp Hotline</strong>
                <p style="font-size: 13px; color: var(--muted); margin-top: 2px;">0852 - 9876 - 5432 (Respon Cepat)</p>
            </div>
        </div>

        <div class="contact-card-item">
            <div class="contact-card-icon">
                <i class='bx bx-envelope'></i>
            </div>
            <div>
                <strong style="display: block; font-size: 14px; color: var(--navy);">Surat Elektronik (Email)</strong>
                <p style="font-size: 13px; color: var(--muted); margin-top: 2px;">info@incitrack.id / support@incitrack.id</p>
            </div>
        </div>
    </div>

    <!-- Right Column: Contact Form Card -->
    <div class="card" style="padding: var(--space-5);">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: 8px;">
            Kirim Pesan
        </h2>
        <p style="color: var(--muted); font-size: 14px; margin-bottom: var(--space-4);">
            Isi formulir di bawah ini untuk mengirimkan kritik, saran, atau pertanyaan kepada manajemen INCITRACK.
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-error">
                <i class='bx bx-error-circle'></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('kontak.post') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-user'></i>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        class="form-control" 
                        placeholder="Contoh: Aditya Pratama" 
                        value="{{ old('nama') }}" 
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email <span class="required">*</span></label>
                <div class="input-icon-wrapper">
                    <i class='bx bx-envelope'></i>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        placeholder="contoh@domain.com" 
                        value="{{ old('email') }}" 
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="subjek">Subjek Pesan <span class="required">*</span></label>
                <input 
                    type="text" 
                    name="subjek" 
                    id="subjek" 
                    class="form-control" 
                    placeholder="Contoh: Permintaan data titik rawan Tol Cipularang" 
                    value="{{ old('subjek') }}" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="pesan">Pesan Anda <span class="required">*</span></label>
                <textarea 
                    name="pesan" 
                    id="pesan" 
                    rows="4" 
                    class="form-control" 
                    placeholder="Tuliskan pesan, pertanyaan, atau tanggapan Anda secara terperinci..." 
                    required
                >{{ old('pesan') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-full" style="padding: 13px; font-size: 15px;">
                <i class='bx bx-send'></i>
                <span>Kirim Pesan</span>
            </button>
        </form>
    </div>
</div>
@endsection
