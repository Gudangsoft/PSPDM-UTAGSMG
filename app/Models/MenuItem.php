<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'label', 'tipe', 'nilai', 'icon', 'parent_id',
        'urutan', 'target', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->where('is_active', true)->orderBy('urutan');
    }

    public function allChildren(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('urutan');
    }

    public function getResolvedUrlAttribute(): string
    {
        try {
            return match ($this->tipe) {
                'route' => route($this->nilai),
                'page'  => route('halaman.show', $this->nilai),
                default => $this->nilai ?: '#',
            };
        } catch (\Throwable $e) {
            return '#';
        }
    }

    public function isActive(): bool
    {
        if ($this->tipe === 'route' && $this->nilai) {
            if (request()->routeIs($this->nilai)) return true;
            $base = explode('.', $this->nilai)[0];
            if ($base !== $this->nilai) {
                return request()->routeIs($base . '.*');
            }
        }
        if ($this->tipe === 'page' && $this->nilai) {
            return request()->is('halaman/' . $this->nilai);
        }
        return false;
    }

    public function isActiveWithChildren(): bool
    {
        if ($this->isActive()) return true;
        foreach ($this->children as $child) {
            if ($child->isActive()) return true;
        }
        return false;
    }
}
