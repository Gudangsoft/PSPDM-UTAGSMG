<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Dosen;
use App\Models\Pejabat;
use App\Models\Setting;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Database\Seeders\BiayaHalamanSeeder;
use Database\Seeders\KonsentrasiHalamanSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@psmpd-untag.ac.id'],
            [
                'name'     => 'Administrator PSMPD',
                'email'    => 'admin@psmpd-untag.ac.id',
                'password' => Hash::make('admin123'),
            ]
        );

        // Settings default
        $settings = [
            'nama_prodi'  => 'Program Studi Manajemen Program Doktor',
            'singkatan'   => 'PSMPD',
            'alamat'      => 'Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur, Semarang 50233, Jawa Tengah',
            'telepon'     => '(024) 8316405',
            'email'       => 'psmpd@untag-smg.ac.id',
            'visi'        => 'Menjadi Program Studi Manajemen Doktor yang unggul, inovatif, dan berdaya saing global, berbasis nilai-nilai Pancasila dalam pengembangan ilmu manajemen untuk transformasi bangsa.',
            'misi'        => "1. Menyelenggarakan pendidikan doktoral yang berkualitas dan berbasis riset\n2. Menghasilkan karya ilmiah bereputasi internasional yang inovatif\n3. Mengembangkan kerjasama dengan industri, pemerintah, dan lembaga internasional\n4. Memberikan kontribusi nyata bagi pembangunan bangsa berbasis ilmu manajemen",
            'facebook'         => '#',
            'instagram'        => '#',
            'youtube'          => '#',
            'whatsapp'         => '6281234567890',
            'sambutan_nama'    => 'Prof. Dr. Hj. Siti Aminah, M.M.',
            'sambutan_jabatan' => 'Ketua Program Studi',
            'sambutan_isi'     => "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n\nSelamat datang di Program Studi Manajemen Program Doktor (PSMPD) Fakultas Ekonomi dan Bisnis Universitas 17 Agustus 1945 Semarang.\n\nPSMPD-FEB UNTAG hadir untuk mencetak pemimpin akademis dan profesional yang unggul, adaptif, dan berintegritas tinggi. Kami berkomitmen memberikan pendidikan doktoral berkualitas yang berbasis riset, berlandaskan nilai-nilai Pancasila, dengan kurikulum yang relevan terhadap dinamika global.\n\nBersama kami, Anda akan menemukan lingkungan akademik yang kondusif, dibimbing oleh promotor-promotor berpengalaman dan bereputasi internasional. Mari bergabung dan wujudkan kontribusi nyata bagi kemajuan ilmu pengetahuan dan bangsa.",
            'cta_aktif'        => '1',
            'cta_label'        => 'Daftar Sekarang',
            'cta_url'          => '',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Dosen sample data
        $dosens = [
            ['nama' => 'Prof. Dr. Hj. Siti Aminah, M.M.', 'nidn' => '0601056601', 'jabatan' => 'Guru Besar / Professor', 'konsentrasi' => 'Manajemen Modal Manusia Strategis', 'keahlian' => 'Manajemen SDM, Kepemimpinan Strategis, Organizational Behavior', 'email' => 'siti.aminah@untag-smg.ac.id', 'urutan' => 1],
            ['nama' => 'Prof. Dr. Bambang Wibowo, S.E., M.Si.', 'nidn' => '0512056801', 'jabatan' => 'Guru Besar / Professor', 'konsentrasi' => 'Manajemen Ekosistem Pasar Inovatif', 'keahlian' => 'Pemasaran Strategis, Inovasi Bisnis, Digital Marketing', 'email' => 'b.wibowo@untag-smg.ac.id', 'urutan' => 2],
            ['nama' => 'Dr. Hj. Retno Wulandari, S.E., M.M.', 'nidn' => '0715077001', 'jabatan' => 'Lektor Kepala', 'konsentrasi' => 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan', 'keahlian' => 'Manajemen Keuangan, ESG, Corporate Governance', 'email' => 'r.wulandari@untag-smg.ac.id', 'urutan' => 3],
            ['nama' => 'Dr. Ahmad Fauzi, S.E., M.Sc.', 'nidn' => '0820087501', 'jabatan' => 'Lektor Kepala', 'konsentrasi' => 'Manajemen Modal Manusia Strategis', 'keahlian' => 'Human Capital, Talent Management, HR Analytics', 'email' => 'a.fauzi@untag-smg.ac.id', 'urutan' => 4],
            ['nama' => 'Dr. Dyah Kusuma Dewi, S.E., M.M.', 'nidn' => '0305087201', 'jabatan' => 'Lektor', 'konsentrasi' => 'Manajemen Ekosistem Pasar Inovatif', 'keahlian' => 'Transformasi Digital, E-Commerce, Market Analysis', 'email' => 'd.kusuma@untag-smg.ac.id', 'urutan' => 5],
            ['nama' => 'Dr. Ir. Hendra Pratama, M.B.A.', 'nidn' => '0422077801', 'jabatan' => 'Lektor', 'konsentrasi' => 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan', 'keahlian' => 'Keuangan Berkelanjutan, Manajemen Risiko, Etika Bisnis', 'email' => 'h.pratama@untag-smg.ac.id', 'urutan' => 6],
        ];
        foreach ($dosens as $d) {
            Dosen::updateOrCreate(['nidn' => $d['nidn']], $d + ['is_active' => true]);
        }

        // Berita sample data
        $beritaList = [
            [
                'judul'        => 'PSMPD-FEB UNTAG Raih Akreditasi Unggul dari BAN-PT',
                'kategori'     => 'Prestasi',
                'ringkasan'    => 'Program Studi Manajemen Program Doktor FEB UNTAG Semarang berhasil meraih akreditasi tertinggi "Unggul" dari Badan Akreditasi Nasional Perguruan Tinggi.',
                'konten'       => '<p>Program Studi Manajemen Program Doktor (PSMPD) Fakultas Ekonomi dan Bisnis Universitas 17 Agustus 1945 Semarang dengan bangga mengumumkan keberhasilan meraih akreditasi <strong>"Unggul"</strong> dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT).</p><p>Pencapaian ini merupakan bukti nyata komitmen program studi dalam menyelenggarakan pendidikan doktoral yang berkualitas tinggi, didukung oleh tenaga pengajar yang kompeten dan infrastruktur penelitian yang memadai.</p><p>Ketua Program Studi menyampaikan apresiasi yang sebesar-besarnya kepada seluruh civitas akademika yang telah berdedikasi dalam mewujudkan standar mutu pendidikan tertinggi.</p>',
                'penulis'      => 'Admin PSMPD',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'judul'        => 'Seminar Internasional: Transformasi Manajemen di Era Digital',
                'kategori'     => 'Kegiatan',
                'ringkasan'    => 'PSMPD-FEB UNTAG menyelenggarakan seminar internasional dengan menghadirkan pembicara dari universitas-universitas ternama di Asia Tenggara.',
                'konten'       => '<p>Program Studi Manajemen Program Doktor FEB UNTAG Semarang sukses menyelenggarakan Seminar Internasional bertema <strong>"Transformasi Manajemen di Era Digital: Tantangan dan Peluang"</strong>.</p><p>Kegiatan ini menghadirkan tiga pembicara utama dari Malaysia, Singapura, dan Thailand yang merupakan pakar di bidang digital transformation dan strategic management.</p><p>Lebih dari 200 peserta hadir dalam seminar ini, terdiri dari mahasiswa doktoral, dosen, dan praktisi bisnis dari berbagai institusi di Indonesia.</p>',
                'penulis'      => 'Admin PSMPD',
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
            [
                'judul'        => 'Mahasiswa PSMPD Raih Best Paper dalam Konferensi Internasional',
                'kategori'     => 'Prestasi',
                'ringkasan'    => 'Mahasiswa Program Doktor Manajemen FEB UNTAG berhasil meraih penghargaan Best Paper dalam konferensi manajemen internasional di Kuala Lumpur.',
                'konten'       => '<p>Membanggakan! Mahasiswa Program Studi Manajemen Program Doktor FEB UNTAG Semarang berhasil meraih penghargaan <strong>Best Paper</strong> dalam International Conference on Management and Business (ICMB) yang diselenggarakan di Kuala Lumpur, Malaysia.</p><p>Paper berjudul "Sustainable Human Capital Management in Indonesian State-Owned Enterprises" ini ditulis oleh mahasiswa semester IV di bawah bimbingan dosen promotor.</p><p>Pencapaian ini semakin mengukuhkan reputasi PSMPD-FEB UNTAG sebagai penghasil penelitian manajemen berkualitas internasional.</p>',
                'penulis'      => 'Admin PSMPD',
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
        ];
        foreach ($beritaList as $b) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($b['judul'])],
                $b + ['slug' => Str::slug($b['judul'])]
            );
        }

        // Pengumuman sample data
        $pengumumans = [
            [
                'judul'         => 'Penerimaan Mahasiswa Baru Program Doktor Manajemen Gelombang I Tahun Akademik 2025/2026',
                'konten'        => "PSMPD-FEB UNTAG Semarang membuka pendaftaran Mahasiswa Baru Program Doktor Manajemen Gelombang I Tahun Akademik 2025/2026.\n\nPeriode Pendaftaran: 1 Februari – 30 April 2025\nSeleksi Administrasi: Mei 2025\nTes Tertulis & Wawancara: Mei 2025\nPengumuman: Juni 2025\nAwal Perkuliahan: September 2025\n\nInformasi lengkap dan formulir pendaftaran tersedia di kantor program studi atau melalui website resmi.",
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'is_active'     => true,
            ],
            [
                'judul'         => 'Jadwal Ujian Proposal Disertasi Semester Gasal 2024/2025',
                'konten'        => "Kepada seluruh mahasiswa Program Doktor Manajemen yang telah memenuhi syarat, diberitahukan bahwa ujian proposal disertasi akan dilaksanakan pada:\n\nWaktu: Bulan Januari - Februari 2025\nTempat: Ruang Sidang FEB UNTAG Semarang\n\nMahasiswa yang akan mengikuti ujian proposal harap menghubungi sekretariat program studi untuk konfirmasi jadwal dan kelengkapan persyaratan.",
                'tanggal_mulai' => now()->subDays(5),
                'tanggal_selesai' => now()->addMonth(),
                'is_active'     => true,
            ],
        ];
        foreach ($pengumumans as $p) {
            Pengumuman::create($p);
        }

        // Pejabat (struktur organisasi) sample data
        $pejabatList = [
            [
                'nama'       => 'Prof. Dr. Hj. Siti Aminah, M.M.',
                'jabatan'    => 'Ketua Program Studi',
                'nidn'       => '0601056601',
                'email'      => 'siti.aminah@untag-smg.ac.id',
                'telepon'    => '(024) 8316405',
                'keterangan' => 'Guru Besar bidang Manajemen Sumber Daya Manusia. Berpengalaman lebih dari 25 tahun dalam dunia akademik dan penelitian manajemen.',
                'urutan'     => 1,
                'is_active'  => true,
            ],
            [
                'nama'       => 'Dr. Ahmad Fauzi, S.E., M.Sc.',
                'jabatan'    => 'Sekretaris Program Studi',
                'nidn'       => '0820087501',
                'email'      => 'a.fauzi@untag-smg.ac.id',
                'telepon'    => '',
                'keterangan' => 'Lektor Kepala bidang Human Capital dan Talent Management. Koordinator kegiatan akademik program doktor.',
                'urutan'     => 2,
                'is_active'  => true,
            ],
            [
                'nama'       => 'Dr. Hj. Retno Wulandari, S.E., M.M.',
                'jabatan'    => 'Koordinator Akademik',
                'nidn'       => '0715077001',
                'email'      => 'r.wulandari@untag-smg.ac.id',
                'telepon'    => '',
                'keterangan' => 'Lektor Kepala bidang Manajemen Keuangan dan ESG. Bertanggung jawab atas koordinasi kurikulum dan proses akademik.',
                'urutan'     => 3,
                'is_active'  => true,
            ],
            [
                'nama'       => 'Dr. Dyah Kusuma Dewi, S.E., M.M.',
                'jabatan'    => 'Koordinator Kemahasiswaan',
                'nidn'       => '0305087201',
                'email'      => 'd.kusuma@untag-smg.ac.id',
                'telepon'    => '',
                'keterangan' => 'Lektor bidang Transformasi Digital dan E-Commerce. Bertanggung jawab atas kegiatan kemahasiswaan dan alumni.',
                'urutan'     => 4,
                'is_active'  => true,
            ],
            [
                'nama'       => 'Dra. Sri Rahayu, M.M.',
                'jabatan'    => 'Kepala Tata Usaha',
                'nidn'       => null,
                'email'      => 'tata.usaha.psmpd@untag-smg.ac.id',
                'telepon'    => '(024) 8316405',
                'keterangan' => 'Mengelola administrasi dan kesekretariatan program studi.',
                'urutan'     => 5,
                'is_active'  => true,
            ],
        ];
        foreach ($pejabatList as $p) {
            Pejabat::updateOrCreate(['nidn' => $p['nidn'] ?? null, 'nama' => $p['nama']], $p);
        }

        // Menu items (only seed if empty)
        if (MenuItem::count() === 0) {
            $beranda = MenuItem::create(['label'=>'Beranda','tipe'=>'route','nilai'=>'home','urutan'=>1,'is_active'=>true]);

            $tentang = MenuItem::create(['label'=>'Tentang','tipe'=>'url','nilai'=>'#','urutan'=>2,'is_active'=>true]);
            MenuItem::create(['label'=>'Profil Program','tipe'=>'route','nilai'=>'tentang','icon'=>'bi-info-circle','parent_id'=>$tentang->id,'urutan'=>1,'is_active'=>true]);
            MenuItem::create(['label'=>'Struktur Organisasi','tipe'=>'route','nilai'=>'struktur','icon'=>'bi-diagram-2','parent_id'=>$tentang->id,'urutan'=>2,'is_active'=>true]);
            MenuItem::create(['label'=>'Dosen & Staf','tipe'=>'route','nilai'=>'dosen','icon'=>'bi-people','parent_id'=>$tentang->id,'urutan'=>3,'is_active'=>true]);

            $akademik = MenuItem::create(['label'=>'Akademik','tipe'=>'url','nilai'=>'#','urutan'=>3,'is_active'=>true]);
            MenuItem::create(['label'=>'Konsentrasi','tipe'=>'route','nilai'=>'konsentrasi','icon'=>'bi-diagram-3','parent_id'=>$akademik->id,'urutan'=>1,'is_active'=>true]);
            MenuItem::create(['label'=>'Profil Lulusan','tipe'=>'route','nilai'=>'profil-lulusan','icon'=>'bi-mortarboard','parent_id'=>$akademik->id,'urutan'=>2,'is_active'=>true]);
            MenuItem::create(['label'=>'Kurikulum & Syarat','tipe'=>'route','nilai'=>'akademik','icon'=>'bi-book','parent_id'=>$akademik->id,'urutan'=>3,'is_active'=>true]);

            MenuItem::create(['label'=>'Penelitian','tipe'=>'route','nilai'=>'penelitian','urutan'=>4,'is_active'=>true]);

            $informasi = MenuItem::create(['label'=>'Informasi','tipe'=>'url','nilai'=>'#','urutan'=>5,'is_active'=>true]);
            MenuItem::create(['label'=>'Berita','tipe'=>'route','nilai'=>'berita.index','icon'=>'bi-newspaper','parent_id'=>$informasi->id,'urutan'=>1,'is_active'=>true]);
            MenuItem::create(['label'=>'Pengumuman','tipe'=>'route','nilai'=>'pengumuman.index','icon'=>'bi-bell','parent_id'=>$informasi->id,'urutan'=>2,'is_active'=>true]);

            MenuItem::create(['label'=>'Galeri','tipe'=>'route','nilai'=>'galeri','urutan'=>6,'is_active'=>true]);
            MenuItem::create(['label'=>'Kontak','tipe'=>'route','nilai'=>'kontak','urutan'=>7,'is_active'=>true]);
        }

        $this->call(BiayaHalamanSeeder::class);
        $this->call(KonsentrasiHalamanSeeder::class);

        $this->command->info('✅ Seeding selesai! Login admin: admin@psmpd-untag.ac.id / admin123');
    }
}
