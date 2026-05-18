<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $roles = [
            ['nama' => 'Admin SDM',        'slug' => 'admin-sdm',        'permissions' => json_encode(['sdm'])],
            ['nama' => 'Admin PMB',         'slug' => 'admin-pmb',        'permissions' => json_encode(['pmb'])],
            ['nama' => 'Admin Komunikasi',  'slug' => 'admin-komunikasi', 'permissions' => json_encode(['komunikasi'])],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['slug' => $role['slug']],
                array_merge($role, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    public function down(): void
    {
        DB::table('roles')->whereIn('slug', ['admin-sdm', 'admin-pmb', 'admin-komunikasi'])->delete();
    }
};
