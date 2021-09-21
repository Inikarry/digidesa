<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiMasuk extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_masuk';

    protected $fillable = [
        'rm_pengirim',
        'rm_nomor',
        'rm_tanggal',
        'rm_perihal',
        'rm_status',
        'rm_foto'
    ];

    public $timestamps = false;
}
