<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kependudukan extends Model
{
    use HasFactory;

    protected $table = 'kependudukan';
    protected $fillable = [
    	'id_desa',
        'awal_l',
        'awal_p',
    	'lahir_l',
    	'lahir_p',
    	'mati_l',
    	'mati_p',
        'datang_l',
        'datang_p',
        'pindah_l',
        'pindah_p',
        'kk',
        'kependudukan_tanggal',
    ];

    public $timestamps = false;
}
