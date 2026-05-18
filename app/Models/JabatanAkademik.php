<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabatanAkademik extends Model
{
    protected $table    = 'jabatan_akademik';
    protected $fillable = ['nama', 'urutan', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
