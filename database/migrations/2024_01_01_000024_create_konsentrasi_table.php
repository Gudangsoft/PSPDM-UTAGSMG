<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsentrasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
            $table->string('nama_en', 200)->nullable();
            $table->string('ikon', 60)->default('bi-diagram-3');
            $table->string('warna_primer', 20)->default('#C0304A');
            $table->string('warna_sekunder', 20)->default('#8B1A2E');
            $table->text('deskripsi');
            $table->text('deskripsi_lanjutan')->nullable();
            $table->text('topik')->nullable(); // JSON array of strings
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        $rows = [
            [
                'nama'               => 'Manajemen Modal Manusia Strategis',
                'nama_en'            => 'Human Capital Strategic Management',
                'ikon'               => 'bi-people-fill',
                'warna_primer'       => '#C0304A',
                'warna_sekunder'     => '#8B1A2E',
                'deskripsi'          => 'Mengkaji pengembangan, pengelolaan, dan optimalisasi sumber daya manusia secara strategis untuk meningkatkan kinerja organisasi dan daya saing institusi di era global.',
                'deskripsi_lanjutan' => 'Konsentrasi ini mempersiapkan mahasiswa untuk menjadi pemimpin SDM yang mampu mengelola modal manusia secara strategis, mengembangkan talenta, dan menciptakan budaya organisasi yang adaptif terhadap perubahan.',
                'topik'              => json_encode(['Manajemen SDM Strategis', 'Pengembangan Organisasi', 'Kepemimpinan Transformasional', 'Manajemen Talenta', 'HR Analytics', 'Budaya & Perubahan Organisasi']),
                'urutan'             => 1,
            ],
            [
                'nama'               => 'Manajemen Ekosistem Pasar Inovatif',
                'nama_en'            => 'Innovative Market Ecosystem Management',
                'ikon'               => 'bi-graph-up-arrow',
                'warna_primer'       => '#1a1a2e',
                'warna_sekunder'     => '#16213e',
                'deskripsi'          => 'Mempelajari dinamika pasar berbasis teknologi, transformasi bisnis, dan strategi pengelolaan ekosistem pasar yang inovatif, adaptif, dan kompetitif di tingkat nasional maupun internasional.',
                'deskripsi_lanjutan' => 'Mahasiswa akan dipersiapkan untuk memahami dan mengelola ekosistem pasar digital, mengembangkan strategi inovasi bisnis, dan memimpin transformasi organisasi di era industri 4.0.',
                'topik'              => json_encode(['Pemasaran Digital', 'Inovasi Bisnis', 'Transformasi Digital', 'Manajemen Merek Global', 'Analitik Pasar', 'Strategi Kompetitif']),
                'urutan'             => 2,
            ],
            [
                'nama'               => 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan',
                'nama_en'            => 'Ethical Finance & Sustainable Development Management',
                'ikon'               => 'bi-currency-exchange',
                'warna_primer'       => '#c8a84b',
                'warna_sekunder'     => '#a0822a',
                'deskripsi'          => 'Mengintegrasikan prinsip etika, tata kelola keuangan yang bertanggung jawab, dan strategi pengembangan berkelanjutan untuk menciptakan nilai ekonomi yang berdampak sosial dan lingkungan positif.',
                'deskripsi_lanjutan' => 'Konsentrasi ini mempersiapkan pemimpin keuangan yang mampu mengelola aset secara etis, menerapkan prinsip ESG (Environmental, Social, Governance), dan merancang strategi keberlanjutan jangka panjang.',
                'topik'              => json_encode(['Keuangan Berkelanjutan', 'ESG & Green Finance', 'Etika Bisnis', 'Tata Kelola Perusahaan', 'Manajemen Risiko', 'Corporate Governance']),
                'urutan'             => 3,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('konsentrasi')->insert(array_merge($row, [
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('konsentrasi');
    }
};
