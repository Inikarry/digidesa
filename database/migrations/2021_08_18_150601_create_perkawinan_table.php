<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkawinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkawinan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_desa')->nullable();
            $table->string('perkawinan_nik')->nullable();
            $table->string('perkawinan_nama')->nullable();
            $table->string('perkawinan_tempat_lahir')->nullable();
            $table->date('perkawinan_tanggal_lahir')->nullable();
            $table->date('perkawinan_tanggal_nikah')->nullable();
            $table->string('perkawinan_buku_nikah')->nullable();
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
        Schema::dropIfExists('perkawinan');
    }
}
