<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $fillable = [
    	'masuk_nomor',
        'masuk_berkas',
        'masuk_pengirim',
        'masuk_perihal',
    	'masuk_foto',
        'masuk_tanggal',
        'masuk_petunjuk',
        'masuk_paket',
    ];

    public $timestamps = false;
}
