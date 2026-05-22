<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop and recreate with new structure (no real data yet)
        Schema::dropIfExists('riset_unggulan');

        Schema::create('riset_unggulan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->string('warna', 20)->default('#C0304A');
            $table->string('topik_a')->nullable();
            $table->string('topik_b')->nullable();
            $table->string('topik_c')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('riset_unggulan')->insert([
            [
                'judul'     => 'Manajemen Human Capital Strategis',
                'deskripsi' => 'Pengembangan SDM, kepemimpinan, dan modal psikologis organisasi',
                'warna'     => '#C0304A',
                'topik_a'   => 'Kepemimpinan Ambidextrous di Era VUCA & Disrupsi Digital',
                'topik_b'   => 'Gig Economy & Manajemen Talenta Fleksibel dalam Pengembangan Kompetensi SDM',
                'topik_c'   => 'Psychological Capital & Well-being Berbasis Neurosains Organisasi',
                'urutan' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'judul'     => 'Manajemen Ekosistem Pasar Inovatif',
                'deskripsi' => 'Platform digital, inovasi terbuka, dan dinamika ekosistem bisnis',
                'warna'     => '#0d9488',
                'topik_a'   => 'Platform Economics & Network Effect pada Pasar Digital',
                'topik_b'   => 'Gig Economy sebagai Model Bisnis Baru: Loyalitas & Keterlibatan Pekerja Platform Digital',
                'topik_c'   => 'Co-creation & Open Innovation dalam Ekosistem Bisnis',
                'urutan' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'judul'     => 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan',
                'deskripsi' => 'ESG, investasi berkelanjutan, dan manajemen risiko keuangan',
                'warna'     => '#1d4ed8',
                'topik_a'   => 'ESG Integration & Impact Measurement dalam Investasi',
                'topik_b'   => 'Gig Economy & Inklusi Keuangan: Perlindungan Investasi bagi Pekerja Independen',
                'topik_c'   => 'Climate Scenario Analysis dalam Manajemen Risiko Keuangan',
                'urutan' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('riset_unggulan');
    }
};
