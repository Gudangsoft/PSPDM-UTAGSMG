<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'foto', 'password', 'role_id'];

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) return asset('storage/' . $this->foto);
        return '';
    }
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role && in_array('all', $this->role->permissions ?? []);
    }

    public function can($ability, $arguments = []): bool
    {
        // Laravel built-in Gate check first
        if (parent::can($ability, $arguments)) return true;
        return false;
    }

    public function hasPermission(string $module): bool
    {
        if (!$this->role) return false;
        return $this->role->can($module);
    }
}
