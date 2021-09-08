<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKenaikanTahunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan_tahun', function (Blueprint $table) {
            $table->id();
            $table->integer('kt_id_pegawai')->nullable();
            $table->string('kt_reg')->nullable();
            $table->string('kt_pil')->nullable();
            $table->string('kt_ijazah')->nullable();
            $table->string('kt_apr')->nullable();
            $table->string('kt_oct')->nullable();
            $table->integer('kt_tahun')->nullable();
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
        Schema::dropIfExists('kenaikan_tahun');
    }
}
