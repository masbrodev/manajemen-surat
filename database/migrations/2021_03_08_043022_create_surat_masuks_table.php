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
            $table->string('perihal');
            $table->longText('idk')->nullable(); //ISI DISPOSISI KABAG	
            $table->string('lajur_disposisi')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('id_berkas');
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
