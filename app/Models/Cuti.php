<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $fillable = [
    	'cuti_nama',
        'nip',
        'cuti_tanggal',
    	'cuti_mulai',
    	'cuti_selesai',
    	'cuti_jenis',
    	'keterangan',
    ];

    public $timestamps = false;
}
