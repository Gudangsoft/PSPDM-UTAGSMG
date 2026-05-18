<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('cover_foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('album_id')->nullable()->after('id')
                  ->constrained('albums')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Album::class);
            $table->dropColumn('album_id');
        });
        Schema::dropIfExists('albums');
    }
};
