<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKependudukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kependudukan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_desa')->nullable();
            $table->integer('awal_l')->nullable();
            $table->integer('awal_p')->nullable();
            $table->integer('lahir_l')->nullable();
            $table->integer('lahir_p')->nullable();
            $table->integer('mati_l')->nullable();
            $table->integer('mati_p')->nullable();
            $table->integer('datang_l')->nullable();
            $table->integer('datang_p')->nullable();
            $table->integer('pindah_l')->nullable();
            $table->integer('pindah_p')->nullable();
            $table->integer('kk')->nullable();
            $table->date('kependudukan_tanggal')->nullable();
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
        Schema::dropIfExists('kependudukan');
    }
}
