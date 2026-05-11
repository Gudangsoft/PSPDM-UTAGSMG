<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Remove any existing konsentrasi menu item (old position under Akademik)
        DB::table('menu_items')
            ->where('nilai', 'konsentrasi')
            ->where('tipe', 'route')
            ->delete();

        // Shift top-level items with urutan >= 4 to make room
        DB::table('menu_items')
            ->whereNull('parent_id')
            ->where('urutan', '>=', 4)
            ->increment('urutan');

        DB::table('menu_items')->insert([
            'label'      => 'Konsentrasi Program Studi',
            'tipe'       => 'route',
            'nilai'      => 'konsentrasi',
            'icon'       => 'bi-diagram-3',
            'parent_id'  => null,
            'urutan'     => 4,
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

        DB::table('menu_items')
            ->whereNull('parent_id')
            ->where('urutan', '>', 4)
            ->decrement('urutan');
    }
};
