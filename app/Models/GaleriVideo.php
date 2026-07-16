<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    protected $table = 'galeri_video';

    protected $fillable = ['judul', 'platform', 'url', 'deskripsi', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return match ($this->platform) {
            'youtube'   => $this->youtubeEmbedUrl(),
            'instagram' => $this->instagramEmbedUrl(),
            'tiktok'    => $this->tiktokEmbedUrl(),
            default     => null,
        };
    }

    public function getPlatformLabelAttribute(): string
    {
        return match ($this->platform) {
            'youtube'   => 'YouTube',
            'instagram' => 'Instagram',
            'tiktok'    => 'TikTok',
            default     => ucfirst($this->platform),
        };
    }

    public function getPlatformIconAttribute(): string
    {
        return match ($this->platform) {
            'youtube'   => 'bi-youtube',
            'instagram' => 'bi-instagram',
            'tiktok'    => 'bi-tiktok',
            default     => 'bi-play-circle',
        };
    }

    private function youtubeEmbedUrl(): ?string
    {
        $id = self::extractYoutubeId($this->url);
        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }

    private function instagramEmbedUrl(): ?string
    {
        $url = rtrim(strtok($this->url, '?'), '/');
        return $url ? $url . '/embed' : null;
    }

    private function tiktokEmbedUrl(): ?string
    {
        $id = self::extractTiktokId($this->url);
        return $id ? "https://www.tiktok.com/embed/v2/{$id}" : null;
    }

    public static function detectPlatform(string $url): ?string
    {
        $host = strtolower(parse_url($url, PHP_URL_HOST) ?? '');

        return match (true) {
            str_contains($host, 'youtube.com'), str_contains($host, 'youtu.be') => 'youtube',
            str_contains($host, 'instagram.com') => 'instagram',
            str_contains($host, 'tiktok.com')     => 'tiktok',
            default => null,
        };
    }

    public static function extractYoutubeId(string $url): ?string
    {
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|shorts\/|embed\/|live\/))([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    public static function extractTiktokId(string $url): ?string
    {
        if (preg_match('/\/video\/(\d+)/', $url, $m)) {
            return $m[1];
        }
        return null;
    }
}
