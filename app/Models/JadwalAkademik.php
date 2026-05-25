<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JadwalAkademik extends Model
{
    protected $table = 'jadwal_akademik';

    protected $fillable = [
        'tahun_akademik', 'semester', 'no_urut',
        'periode', 'kegiatan', 'jenis', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('tahun_akademik')
            ->orderByRaw("FIELD(semester,'gasal','genap')")
            ->orderBy('no_urut');
    }

    public static function jenisLabel(string $jenis): string
    {
        return match($jenis) {
            'administrasi' => 'Administrasi',
            'perkuliahan'  => 'Perkuliahan',
            'evaluasi'     => 'Evaluasi',
            'sidang'       => 'Sidang',
            default        => $jenis,
        };
    }

    public static function jenisBadgeClass(string $jenis): string
    {
        return match($jenis) {
            'administrasi' => 'bg-primary-subtle text-primary border-primary-subtle',
            'perkuliahan'  => 'bg-success-subtle text-success border-success-subtle',
            'evaluasi'     => 'bg-warning-subtle text-warning border-warning-subtle',
            'sidang'       => 'bg-danger-subtle text-danger border-danger-subtle',
            default        => 'bg-secondary-subtle text-secondary',
        };
    }
}
