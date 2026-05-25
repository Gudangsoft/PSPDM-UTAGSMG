<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cari parent "Akademik"
        $parent = DB::table('menu_items')
            ->whereNull('parent_id')
            ->where('label', 'like', '%Akademik%')
            ->first();

        if (!$parent) return;

        // Ambil urutan max anak Akademik
        $maxUrutan = DB::table('menu_items')
            ->where('parent_id', $parent->id)
            ->max('urutan') ?? 0;

        // Cek belum ada
        $exists = DB::table('menu_items')
            ->where('parent_id', $parent->id)
            ->where('label', 'Jadwal Akademik')
            ->exists();

        if (!$exists) {
            DB::table('menu_items')->insert([
                'label'      => 'Jadwal Akademik',
                'tipe'       => 'route',
                'nilai'      => 'jadwal-akademik',
                'icon'       => 'bi bi-calendar3-week',
                'parent_id'  => $parent->id,
                'urutan'     => $maxUrutan + 1,
                'target'     => '_self',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('menu_items')->where('label', 'Jadwal Akademik')->delete();
    }
};
