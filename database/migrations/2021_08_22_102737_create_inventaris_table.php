<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('inventaris_kode')->nullable();
            $table->string('inventaris_register')->nullable();
            $table->string('inventaris_nama')->nullable();
            $table->string('inventaris_merek')->nullable();
            $table->string('inventaris_sertifikat')->nullable();
            $table->string('inventaris_bahan')->nullable();
            $table->string('inventaris_asal_usul')->nullable();
            $table->integer('inventaris_tahun_beli')->nullable();
            $table->string('inventaris_ukuran')->nullable();
            $table->string('inventaris_satuan')->nullable();
            $table->string('inventaris_kondisi')->nullable();
            $table->string('inventaris_awal_jumlah')->nullable();
            $table->string('inventaris_awal_harga')->nullable();
            $table->string('inventaris_kurang_jumlah')->nullable();
            $table->string('inventaris_kurang_harga')->nullable();
            $table->string('inventaris_tambah_jumlah')->nullable();
            $table->string('inventaris_tambah_harga')->nullable();
            $table->string('inventaris_akhir_jumlah')->nullable();
            $table->string('inventaris_akhir_harga')->nullable();
            $table->string('inventaris_ket')->nullable();
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
        Schema::dropIfExists('inventaris');
    }
}
