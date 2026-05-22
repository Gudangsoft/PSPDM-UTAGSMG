<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: add nullable slug column
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nama');
        });

        // Step 2: populate slugs for existing records
        DB::table('dosen')->orderBy('id')->each(function ($dosen) {
            $slug = Str::slug($dosen->nama);
            $base  = $slug;
            $count = 1;
            while (DB::table('dosen')->where('slug', $slug)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('dosen')->where('id', $dosen->id)->update(['slug' => $slug]);
        });

        // Step 3: add unique constraint
        Schema::table('dosen', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
