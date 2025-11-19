<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriHarian extends Model
{
    protected $table = 'galeri_harian';

    protected $fillable = [
        'siswa_id',
        'foto',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
