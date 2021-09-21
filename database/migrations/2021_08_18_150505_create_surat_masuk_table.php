<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('masuk_nomor')->nullable();
            $table->string('masuk_berkas')->nullable();
            $table->string('masuk_pengirim')->nullable();
            $table->string('masuk_perihal')->nullable();
            $table->string('masuk_foto')->nullable();
            $table->date('masuk_tanggal')->nullable();
            $table->string('masuk_petunjuk')->nullable();
            $table->string('masuk_paket')->nullable();
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
        Schema::dropIfExists('surat_masuk');
    }
}
