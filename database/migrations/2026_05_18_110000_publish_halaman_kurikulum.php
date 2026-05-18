<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('halaman')
            ->where('slug', 'akademik-kurikulum')
            ->update(['is_published' => true, 'updated_at' => now()]);
    }

    public function down(): void {}
};
