<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPangkat extends Model
{
    use HasFactory;

    protected $table = 'daftar_pangkat';
    protected $fillable = [
    	'pangkat_nama',
        'pangkat_tanggal_lahir',
        'pangkat_tempat_lahir',
    	'pangkat_nip',
    	'pangkat_karpeg',
    	'pangkat_gol',
    	'pangkat_tmt',
        'jabatan_id',
        'jabatan_tmt',
        'jabatan_eselon',
        'masa_kerja_tahun',
        'masa_kerja_bulan',
        'diklat_nama',
        'diklat_bulan_tahun',
        'diklat_jam',
        'pendidikan_nama',
        'pendidikan_tahun',
        'pendidikan_tingkat',
        'usia_tahun',
        'usia_bulan',
        'pangkat_keterangan',
    ];

    public $timestamps = false;
}
