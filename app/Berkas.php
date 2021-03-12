<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
