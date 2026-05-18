<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'jalan_id',
        'tanggal',
        'waktu',
        'lokasi',
        'jenis',
        'penyebab',
        'dampak',
        'foto',
        'video',
        'status',
        'lat',
        'lng'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jalan()
    {
        return $this->belongsTo(Jalan::class, 'jalan_id');
    }
}
