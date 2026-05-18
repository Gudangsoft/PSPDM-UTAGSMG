<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'waktu', 'lokasi', 'is_active'];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
    ];

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeMendatang($q) { return $q->where('tanggal_mulai', '>=', now()->toDateString()); }
    public function scopeTerurut($q) { return $q->orderBy('tanggal_mulai'); }
}
