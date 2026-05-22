<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nama', 'slug', 'nidn', 'jabatan', 'konsentrasi', 'keahlian',
        'foto', 'email', 'bio', 'google_scholar',
        'sinta_url', 'scopus_url', 'researchgate_url',
        'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($dosen) {
            if (empty($dosen->slug)) {
                $dosen->slug = static::uniqueSlug($dosen->nama);
            }
        });
    }

    public static function uniqueSlug(string $nama, ?int $exceptId = null): string
    {
        $slug  = Str::slug($nama);
        $base  = $slug;
        $count = 1;
        while (static::where('slug', $slug)
                      ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                      ->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.jpg');
    }
}
