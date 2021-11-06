<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiKeluar extends Model
{
    use HasFactory;
   protected $table = 'rekomendasi_keluar';

protected $fillable = [
    'id_masuk',
    'rk_tanggal',
    'rk_tujuan',
    'rk_keterangan',
    'rk_foto'
];

public $timestamps = false;

}
