<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::table('menu_items')
            ->where('nilai', 'konsentrasi')
            ->where('tipe', 'route')
            ->exists();

        if ($exists) {
            return;
        }

        $akademik = DB::table('menu_items')
            ->where('label', 'Akademik')
            ->whereNull('parent_id')
            ->first();

        if (! $akademik) {
            return;
        }

        // Shift existing Akademik children down to make room at urutan=1
        DB::table('menu_items')
            ->where('parent_id', $akademik->id)
            ->increment('urutan');

        DB::table('menu_items')->insert([
            'label'      => 'Konsentrasi Program Studi',
            'tipe'       => 'route',
            'nilai'      => 'konsentrasi',
            'icon'       => 'bi-diagram-3',
            'parent_id'  => $akademik->id,
            'urutan'     => 1,
            'target'     => '_self',
            'is_active'  => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('menu_items')
            ->where('nilai', 'konsentrasi')
            ->where('tipe', 'route')
            ->delete();
    }
};
