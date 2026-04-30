<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100);
            $table->enum('tipe', ['route', 'page', 'url'])->default('route');
            $table->string('nilai', 200)->nullable();
            $table->string('icon', 60)->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->string('target', 10)->default('_self');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
