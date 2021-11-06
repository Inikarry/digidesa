<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanPegawai extends Model
{
    use HasFactory;

    protected $table = 'kenaikan_pegawai';
    protected $fillable = [
    	'kp_nama',
        'kp_nip',
        'kp_dari',
        'kp_dari_tanggal',
        'kp_ke',
        'kp_ke_tanggal',
        'kp_jabatan',
        'kp_jabatan_tanggal',
        'kp_pendidikan',
        'kp_tanggal',
    ];

    public $timestamps = false;
}
