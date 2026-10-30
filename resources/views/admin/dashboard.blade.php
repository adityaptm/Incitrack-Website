@extends('layouts.admin')

@section('content')
<div style="margin-bottom: var(--space-4);">
    <h1 style="font-size: 26px; font-weight: 800; color: var(--navy); margin-bottom: 4px;">
        Dashboard Manajemen Data
    </h1>
    <p style="font-size: 14px; color: var(--muted);">
        Kelola basis data pengguna, ruas jalan tol, verifikasi laporan, dan pesan pengaduan publik
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class='bx bx-check-circle'></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class='bx bx-error-circle'></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if(isset($errors) && $errors->any())
    <div class="alert alert-error">
        <i class='bx bx-error-circle'></i>
        <span>{{ $errors->first() }}</span>
    </div>
@endif

<!-- Horizontal Tabs Bar -->
<div class="admin-tabs-bar">
    <button class="admin-tab-btn active" onclick="switchDashboardTab('users', this)">Pengguna</button>
    <button class="admin-tab-btn" onclick="switchDashboardTab('jalan', this)">Jalan Tol</button>
    <button class="admin-tab-btn" onclick="switchDashboardTab('laporan', this)">Laporan Insiden</button>
    <button class="admin-tab-btn" onclick="switchDashboardTab('contacts', this)">Pesan Kontak</button>
</div>

<!-- ==========================================
     TAB 1: PENGGUNA
     ========================================== -->
<div class="tab-pane-content" id="tab-users">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td><strong>{{ $u->nama }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge badge-{{ $u->role === 'admin' ? 'admin' : 'user' }}">
                            {{ ucfirst($u->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ ($u->status ?? 'aktif') === 'aktif' ? 'valid' : 'invalid' }}">
                            {{ ucfirst($u->status ?? 'aktif') }}
                        </span>
                    </td>
                    <td>
                        @if($u->id !== Auth::id())
                            <form method="POST" action="/admin/user/toggle-status" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status akun {{ $u->nama }}?');" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $u->id }}">
                                <button type="submit" class="btn {{ ($u->status ?? 'aktif') === 'aktif' ? 'btn-warning' : 'btn-success' }}" style="padding: 4px 10px; font-size: 12px;">
                                    <i class='bx bx-power-off'></i>
                                    <span>{{ ($u->status ?? 'aktif') === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                                </button>
                            </form>
                        @else
                            <span style="font-size: 12px; color: var(--muted); font-style: italic;">Akun Anda</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--muted); padding: 24px;">Tidak ada pengguna terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ==========================================
     TAB 2: JALAN TOL
     ========================================== -->
<div class="tab-pane-content" id="tab-jalan" style="display: none;">
    <!-- Inline Add Form -->
    <form method="POST" action="/admin/jalan" class="inline-add-form">
        @csrf
        <input type="text" name="nama_jalan" placeholder="Nama Ruas Jalan Tol" required>
        <input type="text" name="kota" placeholder="Wilayah / Kota Lintasan">
        <input type="number" step="0.01" name="panjang" placeholder="Panjang (km)" required style="max-width: 160px;">
        <button type="submit" class="btn btn-success" style="padding: 10px 18px; white-space: nowrap;">
            <i class='bx bx-plus'></i>
            <span>Tambah Jalan</span>
        </button>
    </form>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jalan Tol</th>
                    <th>Kota / Wilayah</th>
                    <th>Panjang (KM)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jalan as $j)
                <tr>
                    <td>{{ $j->id }}</td>
                    <td><strong>{{ $j->nama_jalan }}</strong></td>
                    <td>{{ $j->kota ?: '-' }}</td>
                    <td>{{ $j->panjang }} km</td>
                    <td>
                        <div style="display: flex; gap: 6px; align-items: center;">
                            <button type="button" class="btn btn-outline" style="padding: 4px 8px; font-size: 12px;" onclick="openEditJalanModal({{ $j->id }}, '{{ addslashes($j->nama_jalan) }}', '{{ addslashes($j->kota) }}', '{{ $j->panjang }}')">
                                <i class='bx bx-edit-alt'></i>
                                <span>Edit</span>
                            </button>

                            <form method="POST" action="/admin/jalan" onsubmit="return confirm('Hapus data ruas jalan tol ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $j->id }}">
                                <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 12px;">
                                    <i class='bx bx-trash'></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--muted); padding: 24px;">Belum ada data jalan tol.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Jalan Tol -->
<div class="modal-overlay" id="editJalanModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Ubah Data Ruas Jalan Tol</h3>
            <button type="button" class="modal-close-btn" onclick="closeEditJalanModal()">&times;</button>
        </div>
        <form method="POST" action="/admin/jalan">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_jalan_id">
            
            <div class="form-group">
                <label>Nama Ruas Jalan Tol</label>
                <input type="text" name="nama_jalan" id="edit_nama_jalan" required>
            </div>
            
            <div class="form-group">
                <label>Wilayah / Kota Lintasan</label>
                <input type="text" name="kota" id="edit_kota">
            </div>
            
            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label>Panjang (KM)</label>
                <input type="number" step="0.01" name="panjang" id="edit_panjang" required>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" onclick="closeEditJalanModal()" class="btn" style="background: #e2e8f0; color: #333;">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
     TAB 3: LAPORAN INSIDEN
     ========================================== -->
<div class="tab-pane-content" id="tab-laporan" style="display: none;">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jalan Tol</th>
                    <th>KM</th>
                    <th>Lokasi Detail</th>
                    <th>Korban</th>
                    <th>Jenis Insiden</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $l)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                    <td><strong>{{ $l->jalan ? $l->jalan->nama_jalan : '-' }}</strong></td>
                    <td><span style="color: var(--primary); font-weight: 700;">{{ $l->km ?: '-' }}</span></td>
                    <td>{{ $l->lokasi }}</td>
                    <td>{{ $l->jumlah_korban ?? 0 }} org</td>
                    <td>{{ $l->jenis }}</td>
                    <td>
                        <div style="display: flex; gap: 6px; align-items: center;">
                            @if($l->foto)
                                <a href="{{ asset('uploads/'.$l->foto) }}" target="_blank" title="Lihat Foto Bukti">
                                    <img src="{{ asset('uploads/'.$l->foto) }}" alt="Bukti" style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border);">
                                </a>
                            @endif
                            @if($l->video)
                                <a href="{{ asset('uploads/'.$l->video) }}" target="_blank" class="btn btn-outline" style="padding: 2px 6px; font-size: 11px;" title="Lihat Video">
                                    <i class='bx bx-video'></i>
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($l->status) }}">
                            @if(strtolower($l->status) === 'valid')
                                Valid
                            @elseif(strtolower($l->status) === 'invalid')
                                Invalid
                            @else
                                Pending
                            @endif
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                            @if($l->status === 'pending')
                                <form method="POST" action="/admin/verifikasi" onsubmit="return confirm('Verifikasi laporan ini sebagai VALID?');" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $l->id }}">
                                    <input type="hidden" name="status" value="valid">
                                    <button type="submit" class="btn btn-success" style="padding: 4px 8px; font-size: 11px;">
                                        <i class='bx bx-check'></i> Valid
                                    </button>
                                </form>
                                <form method="POST" action="/admin/verifikasi" onsubmit="return confirm('Tandai laporan ini sebagai TIDAK VALID?');" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $l->id }}">
                                    <input type="hidden" name="status" value="invalid">
                                    <button type="submit" class="btn btn-warning" style="padding: 4px 8px; font-size: 11px;">
                                        <i class='bx bx-x'></i> Invalid
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="/admin/laporan" onsubmit="return confirm('Hapus laporan insiden ini permanen?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $l->id }}">
                                <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 11px;">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; color: var(--muted); padding: 24px;">Belum ada laporan insiden terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ==========================================
     TAB 4: PESAN KONTAK
     ========================================== -->
<div class="tab-pane-content" id="tab-contacts" style="display: none;">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Waktu Masuk</th>
                    <th>Nama Pengirim</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Isi Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $c)
                <tr>
                    <td>{{ $c->created_at ? $c->created_at->format('d/m/Y H:i') : '-' }}</td>
                    <td><strong>{{ $c->nama }}</strong></td>
                    <td>
                        <a href="mailto:{{ $c->email }}" style="color: var(--primary); font-weight: 500;">
                            {{ $c->email }}
                        </a>
                    </td>
                    <td>{{ $c->subjek }}</td>
                    <td style="max-width: 320px; word-break: break-word;">
                        {{ Str::limit($c->pesan, 100) }}
                    </td>
                    <td>
                        <form method="POST" action="/admin/contact" onsubmit="return confirm('Hapus pesan kontak ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $c->id }}">
                            <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 12px;">
                                <i class='bx bx-trash'></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--muted); padding: 24px;">Tidak ada pesan kontak masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchDashboardTab(tabId, btn) {
    document.querySelectorAll('.tab-pane-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
    
    const target = document.getElementById('tab-' + tabId);
    if (target) {
        target.style.display = 'block';
    }
    if (btn) {
        btn.classList.add('active');
    }
}

function openEditJalanModal(id, nama, kota, panjang) {
    document.getElementById('edit_jalan_id').value = id;
    document.getElementById('edit_nama_jalan').value = nama;
    document.getElementById('edit_kota').value = kota || '';
    document.getElementById('edit_panjang').value = panjang || '';
    
    const modal = document.getElementById('editJalanModal');
    if (modal) modal.classList.add('active');
}

function closeEditJalanModal() {
    const modal = document.getElementById('editJalanModal');
    if (modal) modal.classList.remove('active');
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('editJalanModal');
    if (e.target === modal) {
        closeEditJalanModal();
    }
});
</script>
@endpush
