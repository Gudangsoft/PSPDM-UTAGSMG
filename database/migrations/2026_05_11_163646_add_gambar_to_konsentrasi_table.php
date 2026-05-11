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
        Schema::table('konsentrasi', function (Blueprint $table) {
            $table->string('gambar', 255)->nullable()->after('ikon');
        });
    }

    public function down(): void
    {
        Schema::table('konsentrasi', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
