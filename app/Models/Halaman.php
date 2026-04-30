<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Halaman extends Model
{
    protected $table = 'halaman';

    protected $fillable = [
        'judul', 'slug', 'konten', 'meta_deskripsi', 'is_published', 'urutan',
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
