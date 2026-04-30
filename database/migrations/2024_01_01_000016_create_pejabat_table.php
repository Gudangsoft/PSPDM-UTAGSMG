<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pejabat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('jabatan', 150);
            $table->string('nidn', 20)->nullable();
            $table->string('foto')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telepon', 30)->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pejabat');
    }
};
