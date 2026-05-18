<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('download_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed defaults
        $defaults = ['Brosur', 'Formulir', 'SK', 'Panduan', 'Umum'];
        foreach ($defaults as $i => $nama) {
            DB::table('download_kategoris')->insertOrIgnore([
                'nama'       => $nama,
                'urutan'     => $i,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('download_kategoris');
    }
};
