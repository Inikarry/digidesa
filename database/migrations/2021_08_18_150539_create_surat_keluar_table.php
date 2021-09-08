<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('keluar_berkas')->nullable();
            $table->string('keluar_tujuan')->nullable();
            $table->string('keluar_perihal')->nullable();
            $table->string('keluar_foto')->nullable();
            $table->date('keluar_tanggal')->nullable();
            $table->string('keluar_petunjuk')->nullable();
            $table->string('keluar_nomor')->nullable();
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
        Schema::dropIfExists('surat_keluar');
    }
}
