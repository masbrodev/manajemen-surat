<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SuratMasuk;

class Berkas extends Model
{
    protected $table = 'berkas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_berkas',
        'lokasi',
        'surat_type',
        'surat_id'
    ];

    public function berkas()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_id', 'id');
    }

    public function berkas2()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_id', 'id');
    }
}
