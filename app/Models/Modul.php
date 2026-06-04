<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'modul'; // Ubah ke 'modul'

    protected $fillable = [
        'nama', 'deskripsi', 'gambar', 'gaji'
    ];

    public function absensis()
    {
        return $this->hasMany(\App\Models\Absensi::class, 'modul_id');
    }
}
