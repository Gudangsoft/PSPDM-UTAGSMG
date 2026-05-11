<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Find the Akademik parent menu item
        $akademik = DB::table('menu_items')
            ->where('label', 'Akademik')
            ->whereNull('parent_id')
            ->first();

        if (! $akademik) {
            return;
        }

        // Add Biaya Pendidikan under Akademik if not already present
        $exists = DB::table('menu_items')
            ->where('nilai', 'biaya')
            ->exists();

        if (! $exists) {
            // Shift existing items with urutan >= 4 down by 1
            DB::table('menu_items')
                ->where('parent_id', $akademik->id)
                ->where('urutan', '>=', 4)
                ->increment('urutan');

            DB::table('menu_items')->insert([
                'label'      => 'Biaya Pendidikan',
                'tipe'       => 'route',
                'nilai'      => 'biaya',
                'icon'       => 'bi-cash-coin',
                'parent_id'  => $akademik->id,
                'urutan'     => 4,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('menu_items')->where('nilai', 'biaya')->delete();
    }
};
