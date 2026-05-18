<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['pertanyaan', 'jawaban', 'kategori', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeTerurut($q) { return $q->orderBy('urutan')->orderBy('id'); }
}
