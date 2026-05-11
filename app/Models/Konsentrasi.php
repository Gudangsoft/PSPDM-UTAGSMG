<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsentrasi extends Model
{
    protected $table = 'konsentrasi';

    protected $fillable = [
        'nama', 'nama_en', 'ikon', 'warna_primer', 'warna_sekunder',
        'deskripsi', 'deskripsi_lanjutan', 'topik', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'topik'     => 'array',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
