<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiLaptop extends Model
{
    protected $table = 'mutasi_laptop';

    protected $fillable = [
        'user_id',
        'laptop_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class);
    }
}