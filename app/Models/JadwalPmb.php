<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPmb extends Model
{
    protected $table = 'jadwal_pmb';

    protected $fillable = ['kegiatan', 'periode', 'status', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public static array $statusOptions = [
        'buka'        => ['label' => 'Buka',        'class' => 'bg-success'],
        'proses'      => ['label' => 'Proses',       'class' => 'bg-primary'],
        'belum'       => ['label' => 'Belum',        'class' => 'bg-secondary'],
        'akan_datang' => ['label' => 'Akan Datang',  'class' => 'bg-warning text-dark'],
        'selesai'     => ['label' => 'Selesai',      'class' => 'bg-dark'],
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statusOptions[$this->status]['label'] ?? $this->status;
    }

    public function getStatusClassAttribute(): string
    {
        return self::$statusOptions[$this->status]['class'] ?? 'bg-secondary';
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
