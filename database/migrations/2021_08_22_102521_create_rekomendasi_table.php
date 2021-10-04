<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('rm_pengirim')->nullable();
            $table->string('rm_nomor')->nullable();
            $table->date('rm_tanggal')->nullable();
            $table->string('rm_perihal')->nullable();
            $table->integer('rm_status')->nullable();
            $table->string('rm_foto')->nullable();
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
        Schema::dropIfExists('rekomendasi');
    }
}
