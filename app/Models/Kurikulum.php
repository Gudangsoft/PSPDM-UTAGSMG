<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';

    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks', 'semester',
        'jenis', 'keterangan', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sks'       => 'integer',
        'semester'  => 'integer',
        'urutan'    => 'integer',
    ];

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('semester')->orderBy('urutan');
    }
}
