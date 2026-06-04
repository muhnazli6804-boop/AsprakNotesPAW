<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'modul_id', 'kelas', 'bukti_absensi', 'status', 'tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modul()
    {
        return $this->belongsTo(\App\Models\Modul::class, 'modul_id');
    }

    public function transfer()
    {
        return $this->hasOne(\App\Models\Transfer::class, 'absensi_id');
    }
}
