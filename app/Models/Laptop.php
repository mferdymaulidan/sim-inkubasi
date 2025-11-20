<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $fillable = [
        'siswa_id',
        'brand',
        'model',
        'aksesoris',
        'gambar',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
