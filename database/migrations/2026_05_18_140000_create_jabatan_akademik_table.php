<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan_akademik', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default data
        $now = now();
        $defaults = [
            ['nama' => 'Guru Besar / Professor',   'urutan' => 1],
            ['nama' => 'Lektor Kepala',             'urutan' => 2],
            ['nama' => 'Lektor',                    'urutan' => 3],
            ['nama' => 'Asisten Ahli',              'urutan' => 4],
            ['nama' => 'Dosen Tetap',               'urutan' => 5],
            ['nama' => 'Dosen Tidak Tetap',         'urutan' => 6],
        ];
        foreach ($defaults as $d) {
            DB::table('jabatan_akademik')->insert([...$d, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan_akademik');
    }
};
