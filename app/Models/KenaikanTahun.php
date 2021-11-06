<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanTahun extends Model
{
    use HasFactory;

    protected $table = 'kenaikan_tahun';
    protected $fillable = [
    	'kt_id_pegawai',
        'kt_reg',
        'kt_pil',
        'kt_ijazah',
        'kt_apr',
        'kt_oct',
        'kt_tahun',
    ];

    public $timestamps = false;
}
