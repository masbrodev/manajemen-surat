<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_terima',
        'asal_surat',
        'nomor_surat',
        'perihal',
        'idk',
        'lajur_disposisi',
        'keterangan1',
        'keterangan2',
        'catatan',
        'nomor_agenda',
        'sifat_surat',
        'tindak_lanjut',
    ];
}
