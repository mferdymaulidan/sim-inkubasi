<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function user()
    {
        return $this->hasOne(User::class, 'siswa_id', 'id');
    }
    public function galeri_harian()
    {
        return $this->hasMany(GaleriHarian::class, 'siswa_id', 'id')->wheredate('created_at', now()->toDateString());
    }
    public function laptops()
    {
        return $this->belongsTo(Laptop::class);
    }
}
