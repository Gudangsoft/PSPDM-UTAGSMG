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

    // Only YouTube supports a plain <iframe src="..."> embed. Instagram and
    // TikTok block direct iframe framing (X-Frame-Options/CSP) unless loaded
    // through their own blockquote + embed.js widget, so this is only used
    // for the 'youtube' platform — see galeri-video.blade.php for the rest.
    public function getEmbedUrlAttribute(): ?string
    {
        return $this->platform === 'youtube' ? $this->youtubeEmbedUrl() : null;
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
}
