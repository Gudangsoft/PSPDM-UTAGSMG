<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nama', 'nidn', 'jabatan', 'konsentrasi', 'keahlian',
        'foto', 'email', 'bio', 'google_scholar', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

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
