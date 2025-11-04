<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
