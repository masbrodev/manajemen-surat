<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_keluar');
            $table->string('tujuan_surat');
            $table->string('nomor_surat');
            $table->string('nomor_agenda');
            $table->string('perihal');
            $table->string('konseptor')->nullable();
            $table->longText('keterangan')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->longText('tls')->nullable(); //Tindak Lanjut Staf
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
        Schema::dropIfExists('surat_keluars');
    }
}
