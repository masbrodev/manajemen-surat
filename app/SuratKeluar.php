<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_keluar',
        'tujuan_surat',
        'nomor_surat',
        'perihal',
        'keterangan',
        'id_berkas'
    ];
}
