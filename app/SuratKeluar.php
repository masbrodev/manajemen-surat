<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluars';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_keluar',
        'nomor_agenda',
        'tujuan_surat',
        'nomor_surat',
        'perihal',
        'konseptor',
        'tindak_lanjut',
        'keterangan',
        'tls',
    ];

    public function berkas2()
    {
        return $this->hasMany(Berkas::class, 'surat_id', 'id');
    }
}
