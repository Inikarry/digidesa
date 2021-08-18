<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKematianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kematian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_desa')->nullable();
            $table->string('kematian_nik')->nullable();
            $table->string('kematian_nama')->nullable();
            $table->string('kematian_tempat_lahir')->nullable();
            $table->date('kematian_tanggal_lahir')->nullable();
            $table->date('kematian_tanggal_meninggal')->nullable();
            $table->string('kematian_ket_kematian')->nullable();
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
        Schema::dropIfExists('kematian');
    }
}
