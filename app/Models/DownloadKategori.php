<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadKategori extends Model
{
    protected $table    = 'download_kategoris';
    protected $fillable = ['nama', 'urutan', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];

    public function downloads()
    {
        return $this->hasMany(Download::class, 'kategori', 'nama');
    }

    public function scopeAktif($q) { return $q->where('is_active', true); }
    public function scopeTerurut($q) { return $q->orderBy('urutan')->orderBy('nama'); }
}
