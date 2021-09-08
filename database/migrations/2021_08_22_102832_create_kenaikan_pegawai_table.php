<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKenaikanPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('kp_nama')->nullable();
            $table->string('kp_nip')->nullable();
            $table->string('kp_dari')->nullable();
            $table->string('kp_ke')->nullable();
            $table->string('kp_jabatan')->nullable();
            $table->string('kp_pendidikan')->nullable();
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
        Schema::dropIfExists('kenaikan_pegawai');
    }
}
