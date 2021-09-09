<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;

    protected $table = 'keputusan';
    protected $fillable = [
    	'sk_nomor',
        'sk_tanggal',
        'sk_perihal',
    	'sk_foto',
    ];

    public $timestamps = false;
}
