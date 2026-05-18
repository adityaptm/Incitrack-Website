@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
@endpush


@section('content')
<div class="main">
    <section class="contactHeader">
        <h1>Kontak Kami</h1>
        <p>Silakan hubungi kami melalui form atau kontak langsung di bawah ini.</p>
    </section>

    <section class="container contactContainer">
        <div class="contactDetails">
            <h2>Hubungi INCITRACK</h2>
            <p>
                Kami siap menerima pertanyaan, saran, dan laporan terkait keselamatan jalan di Indonesia.
            </p>
            <ul class="contactList">
                <li>
                    <span class="icon"><i class='bx bx-map'></i></span>
                    <div>
                        <strong>Alamat</strong>
                        <p>Jl. Senayan no.3, Tower C, Jakarta, Indonesia</p>
                    </div>
                </li>
                <li>
                    <span class="icon"><i class='bx bx-phone'></i></span>
                    <div>
                        <strong>Telepon</strong>
                        <p>021 - 1234 - 5678</p>
                    </div>
                </li>
                <li>
                    <span class="icon"><i class='bx bx-mobile-alt'></i></span>
                    <div>
                        <strong>WhatsApp</strong>
                        <p>0852 - 9876 - 5432</p>
                    </div>
                </li>
                <li>
                    <span class="icon"><i class='bx bx-envelope'></i></span>
                    <div>
                        <strong>Email</strong>
                        <p>info@incitrack.id</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="contactFormBox">
            <h2>Kirim Pesan</h2>
            
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('kontak.post') }}">
                @csrf
                <div class="form-group">
                    <input 
                        type="text" 
                        name="nama"
                        placeholder="Nama Lengkap" 
                        required 
                    />
                </div>
                <div class="form-group">
                    <input 
                        type="email" 
                        name="email"
                        placeholder="Email" 
                        required 
                    />
                </div>
                <div class="form-group">
                    <input 
                        type="text" 
                        name="subjek"
                        placeholder="Subjek" 
                        required 
                    />
                </div>
                <div class="form-group">
                    <textarea 
                        name="pesan"
                        placeholder="Tulis pesan Anda di sini..." 
                        rows="6" 
                        required
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-primary btnSubmit" style="width: 100%;">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </section>
</div>
@endsection
