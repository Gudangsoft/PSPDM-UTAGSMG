<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Insert maps_embed setting with empty value if not already present.
        // Admin can fill this from /admin/settings after deployment.
        if (! DB::table('settings')->where('key', 'maps_embed')->exists()) {
            DB::table('settings')->insert([
                'key'        => 'maps_embed',
                'value'      => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('settings')->where('key', 'maps_embed')->delete();
    }
};
