<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';
    protected $fillable = [
    	'inventaris_kode',
        'inventaris_register',
        'inventaris_nama',
    	'inventaris_merek',
    	'inventaris_sertifikat',
    	'inventaris_bahan',
    	'inventaris_asal_usul',
    	'inventaris_tahun_beli',
    	'inventaris_ukuran',
    	'inventaris_satuan',
    	'inventaris_kondisi',
    	'inventaris_awal_jumlah',
    	'inventaris_awal_harga',
    	'inventaris_kurang_jumlah',
    	'inventaris_kurang_harga',
    	'inventaris_tambah_jumlah',
    	'inventaris_tambah_harga',
    	'inventaris_akhir_jumlah',
    	'inventaris_akhir_harga',
    	'inventaris_ket',
    ];

    public $timestamps = false;
}
