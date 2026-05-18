<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Album extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi', 'cover_foto', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function galeri()
    {
        return $this->hasMany(Galeri::class)->orderBy('urutan');
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_foto) {
            return asset('storage/' . $this->cover_foto);
        }
        return 'https://via.placeholder.com/400x300/CC0000/fff?text=Album';
    }

    protected static function booted(): void
    {
        static::creating(function (Album $album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->nama);
            }
        });
    }
}
