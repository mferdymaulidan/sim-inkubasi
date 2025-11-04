<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    /** @use HasFactory<\Database\Factories\DailyReportFactory> */
    use HasFactory;

    protected $fillable=[
        'siswas_id',
        'dokumen',
        'keterangan',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function siswas(){
        return $this->belongsTo(Siswa::class);
    }
}

