<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi_keluar', function (Blueprint $table) {
            $table->id();
            $table->integer('id_masuk')->nullable();
            $table->date('rk_tanggal')->nullable();
            $table->string('rk_tujuan')->nullable();
            $table->string('rk_keterangan')->nullable();
            $table->string('rk_foto')->nullable();
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
        Schema::dropIfExists('rekomendasi_keluar');
    }
}
