<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pejabat extends Model
{
    protected $table = 'pejabat';

    protected $fillable = [
        'nama', 'jabatan', 'nidn', 'foto', 'email',
        'telepon', 'keterangan', 'urutan', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
