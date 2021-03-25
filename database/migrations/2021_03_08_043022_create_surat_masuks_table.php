<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_terima');
            $table->string('asal_surat');
            $table->string('nomor_surat');
            $table->integer('nomor_agenda')->nullable();
            $table->string('sifat_surat')->nullable();
            $table->string('perihal');
            $table->longText('lajur_disposisi')->nullable();
            $table->longText('catatan')->nullable();
            $table->longText('keterangan1')->nullable();
            $table->longText('keterangan2')->nullable();
            $table->longText('tindak_lanjut')->nullable();
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
        Schema::dropIfExists('surat_masuks');
    }
}
