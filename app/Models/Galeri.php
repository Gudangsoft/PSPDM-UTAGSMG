<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = ['judul', 'gambar', 'kategori', 'deskripsi', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    public function getGambarUrlAttribute()
    {
        return asset('storage/' . $this->gambar);
    }
}
