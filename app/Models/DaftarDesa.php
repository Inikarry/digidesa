<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarDesa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $fillable = [
    	'nama_desa'
    ];

    public $timestamps = false;
}
