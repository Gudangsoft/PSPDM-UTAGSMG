<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn')->nullable();
            $table->string('jabatan');
            $table->string('konsentrasi')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->string('google_scholar')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
