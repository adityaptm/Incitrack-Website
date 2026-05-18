<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    protected $table = 'jalans';
    
    const UPDATED_AT = null;

    protected $fillable = [
        'nama_jalan',
        'kota',
        'panjang'
    ];
}
