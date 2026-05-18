<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasis';

    protected $fillable = ['judul', 'penulis', 'jurnal_penerbit', 'tahun', 'url', 'tipe', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeTerurut($q) { return $q->orderByDesc('tahun')->orderBy('judul'); }
}
