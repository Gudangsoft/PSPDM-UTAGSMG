<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('sinta_url')->nullable()->after('google_scholar');
            $table->string('scopus_url')->nullable()->after('sinta_url');
            $table->string('researchgate_url')->nullable()->after('scopus_url');
        });
    }

    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn(['sinta_url', 'scopus_url', 'researchgate_url']);
        });
    }
};
