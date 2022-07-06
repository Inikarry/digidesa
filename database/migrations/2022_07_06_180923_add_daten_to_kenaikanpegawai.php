<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatenToKenaikanpegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kenaikan_pegawai', function (Blueprint $table) {
            $table->date('kp_dari_tanggal')->nullable();
            $table->date('kp_ke_tanggal')->nullable();
            $table->date('kp_jabatan_tanggal')->nullable();
            $table->date('kp_tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kenaikan_pegawai', function (Blueprint $table) {
            $table->dropColumn('kp_dari_tanggal');
            $table->dropColumn('kp_ke_tanggal');
            $table->dropColumn('kp_jabatan_tanggal');
            $table->dropColumn('kp_tanggal');
        });
    }
}
