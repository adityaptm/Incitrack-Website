<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanApiController extends Controller
{

    // GET /api/jalan
    public function jalan()
    {
        $jalan = Jalan::orderBy('nama_jalan')->get();

        return response()->json([
            'success' => true,
            'data' => $jalan
        ]);
    }

    // GET /api/laporan
    public function index()
    {
        $laporan = Laporan::with('jalan','user')
                    ->where('status','valid')
                    ->orderBy('id','desc')
                    ->get();

        return response()->json([
            'success'=>true,
            'data'=>$laporan
        ]);
    }

    // POST /api/laporan
    public function store(Request $request)
    {

        $request->validate([
            'jalan_id'=>'required',
            'tanggal'=>'required|date',
            'waktu'=>'required',
            'lokasi'=>'required',
            'jenis'=>'required',
            'lat'=>'required',
            'lng'=>'required'
        ]);

        $fotoPath='';

        if($request->hasFile('foto')){

            $foto=$request->file('foto');

            $nama='foto_'.time().'.'.$foto->extension();

            $foto->move(public_path('uploads'),$nama);

            $fotoPath=$nama;

        }

        $videoPath='';

        if($request->hasFile('video')){

            $video=$request->file('video');

            $nama='video_'.time().'.'.$video->extension();

            $video->move(public_path('uploads'),$nama);

            $videoPath=$nama;

        }

        $laporan=Laporan::create([

            'user_id'=>Auth::id(),

            'jalan_id'=>$request->jalan_id,

            'tanggal'=>$request->tanggal,

            'waktu'=>$request->waktu,

            'lokasi'=>$request->lokasi,

            'jenis'=>$request->jenis,

            'penyebab'=>$request->penyebab,

            'dampak'=>$request->dampak,

            'foto'=>$fotoPath,

            'video'=>$videoPath,

            'status'=>'pending',

            'lat'=>$request->lat,

            'lng'=>$request->lng

        ]);

        return response()->json([

            'success'=>true,

            'message'=>'Laporan berhasil dikirim',

            'data'=>$laporan

        ],201);

    }

    // GET /api/riwayat
    public function riwayat()
    {

        $laporan=Laporan::with('jalan')
                ->where('user_id',Auth::id())
                ->orderBy('id','desc')
                ->get();

        return response()->json([

            'success'=>true,

            'data'=>$laporan

        ]);

    }

}