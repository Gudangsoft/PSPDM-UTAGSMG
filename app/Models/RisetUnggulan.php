<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RisetUnggulan extends Model
{
    protected $table = 'riset_unggulan';

    protected $fillable = [
        'judul', 'deskripsi', 'icon', 'warna', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
