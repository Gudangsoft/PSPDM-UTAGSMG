<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riset_unggulan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->default('bi-lightbulb');
            $table->string('warna', 20)->default('#C0304A');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data awal dari tampilan statis sebelumnya
        DB::table('riset_unggulan')->insert([
            ['judul' => 'Riset Modal Manusia',   'deskripsi' => 'Penelitian mendalam tentang pengembangan kapasitas SDM, kepemimpinan, dan produktivitas organisasi.', 'icon' => 'bi-people-fill',        'warna' => '#C0304A', 'urutan' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Riset Ekosistem Pasar', 'deskripsi' => 'Kajian transformasi digital, inovasi bisnis, dan dinamika pasar nasional & internasional.',          'icon' => 'bi-graph-up-arrow',     'warna' => '#1a1a2e', 'urutan' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Riset Keuangan Etis',   'deskripsi' => 'Penelitian tentang tata kelola keuangan, ESG, dan keberlanjutan ekonomi jangka panjang.',            'icon' => 'bi-currency-exchange',  'warna' => '#c8a84b', 'urutan' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Kerjasama Internasional','deskripsi' => 'Kolaborasi riset dengan universitas dan lembaga penelitian mancanegara.',                             'icon' => 'bi-globe2',             'warna' => '#2c7a4b', 'urutan' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('riset_unggulan');
    }
};
