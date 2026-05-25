<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_akademik', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_akademik', 20)->default('2026/2027');
            $table->enum('semester', ['gasal', 'genap'])->default('gasal');
            $table->unsignedTinyInteger('no_urut')->default(1);
            $table->string('periode', 100);
            $table->string('kegiatan', 200);
            $table->enum('jenis', ['administrasi', 'perkuliahan', 'evaluasi', 'sidang'])->default('perkuliahan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_akademik');
    }
};
