<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['nama', 'slug', 'permissions', 'is_active'];
    protected $casts    = ['permissions' => 'array', 'is_active' => 'boolean'];

    // Permission modules available
    public static array $modules = [
        'sdm'        => 'SDM & Akademik',
        'konten'     => 'Konten',
        'galeri'     => 'Galeri & Album',
        'pmb'        => 'PMB',
        'komunikasi' => 'Komunikasi',
        'sistem'     => 'Sistem',
        'hak_akses'  => 'Hak Akses',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function can(string $module): bool
    {
        $perms = $this->permissions ?? [];
        return in_array('all', $perms) || in_array($module, $perms);
    }
}
