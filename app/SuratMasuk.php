<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berkas;

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

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'surat_id', 'id');
    }
}
