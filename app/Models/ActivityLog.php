<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'aksi', 'modul', 'deskripsi', 'ip'];

    protected $casts = ['created_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }

    public static function catat(string $aksi, string $modul = null, string $deskripsi = null): void
    {
        static::create([
            'user_id'    => auth()->id(),
            'aksi'       => $aksi,
            'modul'      => $modul,
            'deskripsi'  => $deskripsi,
            'ip'         => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
