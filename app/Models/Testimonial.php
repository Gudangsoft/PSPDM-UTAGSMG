<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['nama', 'jabatan_saat_ini', 'angkatan', 'foto', 'isi', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getFotoUrlAttribute(): string
    {
        return $this->foto ? asset('storage/' . $this->foto) : '';
    }

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeTerurut($q) { return $q->orderBy('urutan')->orderBy('id'); }
}
