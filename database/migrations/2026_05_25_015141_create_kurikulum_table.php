<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 20)->nullable();
            $table->string('nama_mk', 200);
            $table->unsignedTinyInteger('sks')->default(3);
            $table->unsignedTinyInteger('semester')->default(1);
            $table->enum('jenis', ['wajib', 'pilihan'])->default('wajib');
            $table->text('keterangan')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kurikulum');
    }
};
