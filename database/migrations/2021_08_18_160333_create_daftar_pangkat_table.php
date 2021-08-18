<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pangkat', function (Blueprint $table) {
            $table->id();
            $table->string('pangkat_nama')->nullable();
            $table->string('pangkat_tempat_lahir')->nullable();
            $table->date('pangkat_tanggal_lahir')->nullable();
            $table->string('pangkat_nip')->nullable();
            $table->string('pangkat_karpeg')->nullable();
            $table->string('pangkat_gol')->nullable();
            $table->date('pangkat_tmt')->nullable();
            $table->string('jabatan_nama')->nullable();
            $table->date('jabatan_tmt')->nullable();
            $table->string('abatan_eselon')->nullable();
            $table->string('masa_kerja_tahun')->nullable();
            $table->string('masa_kerja_bulab')->nullable();
            $table->string('diklat_nama')->nullable();
            $table->string('diklat_bulan_tahun')->nullable();
            $table->string('diklat_jam')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->integer('pendidikan_tahun')->nullable();
            $table->string('pendidikan_tingkat')->nullable();
            $table->integer('usia_tahun')->nullable();
            $table->integer('usia_bulan')->nullable();
            $table->string('pangkat_keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_pangkat');
    }
}
