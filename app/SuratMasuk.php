<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berkas;
use Illuminate\Support\Str;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_terima',
        'asal_surat',
        'nomor_surat',
        'perihal',
        'lajur_disposisi',
        'keterangan1',
        'keterangan2',
        'catatan',
        'nomor_agenda',
        'sifat_surat',
        'tindak_lanjut',
        'tls',
    ];

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'surat_id', 'id');
    }

    public function nomor(){
        $no = $this->nomor_surat;
        return Str::beforeLast($no, '_tgl_');
    }

    public function tanggal(){
        $tgl = $this->nomor_surat;
        return Str::afterLast($tgl, '_tgl_');
    }
}
