<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKenaikanGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan_gaji', function (Blueprint $table) {
            $table->id();
            $table->string('gaji_nomor')->nullable();
            $table->string('gaji_tujuan')->nullable();
            $table->date('gaji_tanggal')->nullable();
            $table->string('gaji_nama')->nullable();
            $table->string('gaji_foto')->nullable();
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
        Schema::dropIfExists('kenaikan_gaji');
    }
}
