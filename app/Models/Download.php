<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'file', 'ukuran', 'kategori', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file);
    }

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeTerurut($q) { return $q->orderBy('urutan')->orderBy('judul'); }
}
