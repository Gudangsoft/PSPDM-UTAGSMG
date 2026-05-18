<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->json('permissions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')
                  ->constrained('roles')->nullOnDelete();
        });

        $now = now();

        // Super Admin
        $superAdminId = DB::table('roles')->insertGetId([
            'nama'        => 'Super Admin',
            'slug'        => 'super-admin',
            'permissions' => json_encode(['all']),
            'is_active'   => true,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // Editor Konten
        DB::table('roles')->insert([
            'nama'        => 'Editor Konten',
            'slug'        => 'editor-konten',
            'permissions' => json_encode(['konten', 'galeri']),
            'is_active'   => true,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // Admin Galeri
        DB::table('roles')->insert([
            'nama'        => 'Admin Galeri',
            'slug'        => 'admin-galeri',
            'permissions' => json_encode(['galeri']),
            'is_active'   => true,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // Assign Super Admin to existing users
        DB::table('users')->update(['role_id' => $superAdminId]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Role::class);
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('roles');
    }
};
