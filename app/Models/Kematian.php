<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use HasFactory;

    protected $table = 'kematian';
    protected $fillable = [
    	'id_desa',
        'kematian_nik',
        'kematian_nama',
    	'kematian_tempat_lahir',
    	'kematian_tanggal_lahir',
    	'kematian_tanggal_meninggal',
    	'kematian_ket_kematian',
    ];

    public $timestamps = false;
}
