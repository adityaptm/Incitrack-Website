<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jalan;
use App\Models\Laporan;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pengguna' => User::count(),
            'total_jalan' => Jalan::count(),
            'total_laporan' => Laporan::count(),
            'laporan_pending' => Laporan::where('status', 'pending')->count(),
            'laporan_valid' => Laporan::where('status', 'valid')->count(),
            'laporan_invalid' => Laporan::where('status', 'invalid')->count(),
        ];

        $laporan_terbaru = Laporan::with('jalan', 'user')->orderBy('id', 'desc')->take(10)->get()->map(function($l) {
            return [
                'tanggal' => $l->tanggal,
                'nama_jalan' => $l->jalan ? $l->jalan->nama_jalan : null,
                'lokasi' => $l->lokasi,
                'jenis' => $l->jenis,
                'pelapor' => $l->user ? $l->user->nama : null,
                'status' => $l->status
            ];
        });

        return view('admin.home', compact('stats', 'laporan_terbaru'));
    }

    public function dashboard()
    {
        $users = User::all();
        $jalan = Jalan::orderBy('nama_jalan')->get();
        $laporan = Laporan::with('jalan', 'user')->orderBy('id', 'desc')->get();
        $contacts = \App\Models\Contact::orderBy('id', 'desc')->get();

        return view('admin.dashboard', compact('users', 'jalan', 'laporan', 'contacts'));
    }

    public function postVerifikasi(Request $request)
    {
        $laporan = Laporan::findOrFail($request->id);
        $laporan->status = $request->status;
        $laporan->save();
        return back()->with('success', 'Status berhasil diubah');
    }

    public function postJalan(Request $request)
    {
        Jalan::create($request->validate([
            'nama_jalan' => 'required',
            'kota' => 'nullable',
            'panjang' => 'required|numeric'
        ]));
        return back()->with('success', 'Jalan berhasil ditambah');
    }

    public function deleteJalan(Request $request)
    {
        Jalan::destroy($request->id);
        return back()->with('success', 'Jalan berhasil dihapus');
    }

    public function deleteLaporan(Request $request)
    {
        Laporan::destroy($request->id);
        return back()->with('success', 'Laporan berhasil dihapus');
    }

    public function deleteContact(Request $request)
    {
        \App\Models\Contact::destroy($request->id);
        return back()->with('success', 'Pesan kontak berhasil dihapus');
    }
}
