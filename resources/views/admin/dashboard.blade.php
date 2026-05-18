@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush


@section('content')
<h1>Dashboard Manajemen Data</h1>

<div class="tabs">
    <button class="activeTab" onclick="openTab('users', this)">Pengguna</button>
    <button onclick="openTab('jalan', this)">Jalan Tol</button>
    <button onclick="openTab('laporan', this)">Laporan</button>
    <button onclick="openTab('contacts', this)">Pesan Kontak</button>
</div>

<div class="tabContent" id="tab-users">
    <div class="tableWrapper">
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge {{ $u->role === 'admin' ? 'valid' : 'pending' }}">{{ $u->role }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="tabContent" id="tab-jalan" style="display: none;">
    <form method="POST" action="/admin/jalan" class="addForm">
        @csrf
        <input name="nama_jalan" placeholder="Nama Jalan" required />
        <input name="kota" placeholder="Kota" />
        <input type="number" step="0.01" name="panjang" placeholder="Panjang (km)" required />
        <button type="submit" class="btn btn-primary">Tambah Jalan</button>
    </form>
    <div class="tableWrapper">
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Nama Jalan</th><th>Kota</th><th>Panjang (km)</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($jalan as $j)
                <tr>
                    <td>{{ $j->id }}</td>
                    <td>{{ $j->nama_jalan }}</td>
                    <td>{{ $j->kota }}</td>
                    <td>{{ $j->panjang }}</td>
                    <td>
                        <form method="POST" action="/admin/jalan" onsubmit="return confirm('Hapus jalan ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $j->id }}">
                            <button type="submit" class="btn btnDanger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="tabContent" id="tab-laporan" style="display: none;">
    <div class="tableWrapper">
        <table class="table">
            <thead>
                <tr><th>Tgl</th><th>Jalan</th><th>Lokasi</th><th>Jenis</th><th>Bukti</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($laporan as $l)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</td>
                    <td>{{ $l->lokasi }}</td>
                    <td>{{ $l->jenis }}</td>
                    <td>
                        @if($l->foto)
                            <a href="{{ asset('uploads/'.$l->foto) }}" target="_blank">
                                <img src="{{ asset('uploads/'.$l->foto) }}" alt="Foto" style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);" />
                            </a>
                        @endif
                        @if($l->video)
                            <a href="{{ asset('uploads/'.$l->video) }}" target="_blank" style="display: inline-block; font-size: 12px; background: #3498db; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; margin-top: 5px;">
                                <i class='bx bx-video'></i> Video
                            </a>
                        @endif
                    </td>
                    <td><span class="badge {{ $l->status }}">{{ ucfirst($l->status) }}</span></td>
                    <td>
                        <div style="display:flex; gap:5px; flex-wrap: wrap;">
                            @if($l->status === 'pending')
                                <form method="POST" action="/admin/verifikasi" onsubmit="return confirm('Ubah menjadi valid?');">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $l->id }}">
                                    <input type="hidden" name="status" value="valid">
                                    <button type="submit" class="btn btnSuccess" style="padding:5px 10px; font-size: 12px; color: white; border: none; border-radius: 4px; background: var(--success); cursor: pointer;">Valid</button>
                                </form>
                                <form method="POST" action="/admin/verifikasi" onsubmit="return confirm('Ubah menjadi invalid?');">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $l->id }}">
                                    <input type="hidden" name="status" value="invalid">
                                    <button type="submit" class="btn btnWarning" style="padding:5px 10px; font-size: 12px; color: white; border: none; border-radius: 4px; background: var(--warning); cursor: pointer;">Invalid</button>
                                </form>
                            @endif
                            <form method="POST" action="/admin/laporan" onsubmit="return confirm('Hapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $l->id }}">
                                <button type="submit" class="btn btnDanger" style="padding:5px 10px; font-size: 12px; color: white; border: none; border-radius: 4px; background: var(--danger); cursor: pointer;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="tabContent" id="tab-contacts" style="display: none;">
    <div class="tableWrapper">
        <table class="table">
            <thead>
                <tr><th>Tgl / Waktu</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Pesan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($contacts as $c)
                <tr>
                    <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $c->nama }}</td>
                    <td><a href="mailto:{{ $c->email }}" style="color: var(--primary-color); font-weight: 500;">{{ $c->email }}</a></td>
                    <td><strong>{{ $c->subjek }}</strong></td>
                    <td style="max-width: 300px; word-break: break-word;">{{ $c->pesan }}</td>
                    <td>
                        <form method="POST" action="/admin/contact" onsubmit="return confirm('Hapus pesan kontak ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $c->id }}">
                            <button type="submit" class="btn btnDanger" style="padding:5px 10px; font-size: 12px; color: white; border: none; border-radius: 4px; background: var(--danger); cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openTab(tabName, btn) {
    document.querySelectorAll('.tabContent').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tabs button').forEach(el => el.classList.remove('activeTab'));
    document.getElementById('tab-' + tabName).style.display = 'block';
    btn.classList.add('activeTab');
}
</script>
@endpush
