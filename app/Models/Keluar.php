<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $fillable = [
    	'keluar_berkas',
        'keluar_tujuan',
        'keluar_perihal',
    	'keluar_foto',
        'keluar_tanggal',
        'keluar_petunjuk',
        'keluar_nomor',
    ];

    public $timestamps = false;
}
