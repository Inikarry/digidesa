<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'kenaikan_gaji';

    protected $fillable = [
        'gaji_nomor',
        'gaji_tujuan',
        'gaji_tanggal',
        'gaji_nama',
        'gaji_foto',
    ];

    public $timestamps = false;
}
