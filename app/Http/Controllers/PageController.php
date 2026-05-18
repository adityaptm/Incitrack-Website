<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Jalan;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function landing()
    {
        return view('pages.landing');
    }

    public function home()
    {
        $total_kecelakaan = Laporan::count();
        $laporan_terverifikasi = Laporan::where('status', 'valid')->count();
        $peningkatan_keselamatan = $total_kecelakaan > 0 ? round(($laporan_terverifikasi / $total_kecelakaan) * 100) : 0;

        $stats = [
            'total_kecelakaan' => $total_kecelakaan,
            'laporan_terverifikasi' => $laporan_terverifikasi,
            'peningkatan_keselamatan' => $peningkatan_keselamatan
        ];

        return view('pages.home', compact('stats'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function postKontak(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);
        
        \App\Models\Contact::create($data);
        
        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function lapor()
    {
        $jalanList = Jalan::orderBy('nama_jalan', 'asc')->get();
        return view('pages.lapor', compact('jalanList'));
    }

    public function postLapor(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'jalan_id' => 'required',
            'lokasi' => 'required',
            'jenis' => 'required',
            'foto' => 'required|image|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi|max:51200',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $fotoPath = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = 'foto_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $fotoName);
            $fotoPath = $fotoName;
        }

        $videoPath = '';
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = 'video_' . time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('uploads'), $videoName);
            $videoPath = $videoName;
        }

        Laporan::create([
            'user_id' => Auth::id(),
            'jalan_id' => $request->jalan_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'jenis' => $request->jenis,
            'penyebab' => $request->penyebab,
            'dampak' => $request->dampak,
            'foto' => $fotoPath,
            'video' => $videoPath,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Terima kasih sudah melaporkan. Petugas sedang menuju ke sana (menunggu verifikasi admin).');
    }

    public function lihat(Request $request)
    {
        $search = $request->query('search');
        $query = Laporan::with('jalan', 'user')->where('status', 'valid')->orderBy('id', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('lokasi', 'LIKE', "%{$search}%")
                  ->orWhere('jenis', 'LIKE', "%{$search}%")
                  ->orWhereHas('jalan', function($qJalan) use ($search) {
                      $qJalan->where('nama_jalan', 'LIKE', "%{$search}%");
                  });
            });
        }

        $laporan = $query->get();
        return view('pages.lihat', compact('laporan', 'search'));
    }

    public function pengaturan()
    {
        $user = Auth::user();
        $laporan = Laporan::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
        return view('pages.pengaturan', compact('user', 'laporan'));
    }

    public function updatePengaturan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::id()
        ]);

        $user = Auth::user();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function riwayat()
    {
        $laporan = Laporan::with('jalan')->where('user_id', Auth::id())->orderBy('tanggal', 'desc')->get();
        return view('pages.riwayat', compact('laporan'));
    }
}
