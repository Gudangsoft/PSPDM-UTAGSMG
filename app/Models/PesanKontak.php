<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesanKontak extends Model
{
    use HasFactory;

    protected $table = 'pesan_kontak';

    protected $fillable = ['nama', 'email', 'telepon', 'subjek', 'pesan', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
