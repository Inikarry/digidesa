<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkawinan extends Model
{
    use HasFactory;

    protected $table = 'perkawinan';
    protected $fillable = [
    	'id_desa',
        'perkawinan_nik',
        'perkawinan_nama',
    	'perkawinan_tempat_lahir',
    	'perkawinan_tanggal_lahir',
    	'perkawinan_tanggal_nikah',
    	'perkawinan_buku_nikah',
    ];

    public $timestamps = false;
}
