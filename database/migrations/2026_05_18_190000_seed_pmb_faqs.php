<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa persyaratan utama untuk mendaftar Program Doktor Manajemen (PSMPD) FEB UNTAG Semarang?',
                'jawaban'    => "Persyaratan utama pendaftaran PSMPD FEB UNTAG Semarang:\n\n1. Lulusan S2 (Magister) dari perguruan tinggi terakreditasi\n2. IPK S2 minimal 3,00 (skala 4,00)\n3. Memiliki pengalaman kerja atau aktif di dunia akademik\n4. Surat rekomendasi dari 2 orang (akademisi atau profesional)\n5. Proposal penelitian awal (5–10 halaman)\n6. Pas foto terbaru\n7. Fotokopi ijazah dan transkrip nilai S1 dan S2 yang telah dilegalisir\n\nUntuk informasi lengkap, silakan hubungi sekretariat PSMPD.",
                'kategori'   => 'PMB',
                'urutan'     => 1,
            ],
            [
                'pertanyaan' => 'Berapa lama masa studi Program Doktor Manajemen?',
                'jawaban'    => "Masa studi Program Doktor Manajemen PSMPD FEB UNTAG Semarang adalah:\n\n• Masa studi normal: 3 tahun (6 semester)\n• Masa studi maksimal: 7 tahun (14 semester)\n\nMahasiswa yang memiliki kinerja penelitian baik dapat menyelesaikan studi lebih cepat. Program ini dirancang fleksibel sehingga dapat ditempuh sambil tetap menjalankan aktivitas profesional.",
                'kategori'   => 'PMB',
                'urutan'     => 2,
            ],
            [
                'pertanyaan' => 'Apakah kuliah Program Doktor bisa dilakukan sambil bekerja?',
                'jawaban'    => "Ya, Program Doktor Manajemen PSMPD FEB UNTAG Semarang dirancang untuk profesional yang aktif bekerja. Perkuliahan diselenggarakan pada:\n\n• Akhir pekan (Jumat malam, Sabtu, dan Minggu)\n• Atau sesuai jadwal yang disepakati bersama\n\nSebagian besar mahasiswa kami adalah praktisi, dosen, pejabat, dan pengusaha yang tetap aktif di bidang masing-masing selama menempuh studi.",
                'kategori'   => 'PMB',
                'urutan'     => 3,
            ],
            [
                'pertanyaan' => 'Berapa biaya pendidikan Program Doktor Manajemen?',
                'jawaban'    => "Informasi biaya pendidikan PSMPD FEB UNTAG Semarang dapat dilihat di halaman Biaya Pendidikan pada website ini, atau hubungi langsung sekretariat kami melalui:\n\n• Telepon/WhatsApp: tercantum di halaman Kontak\n• Email: psmpd@untag-smg.ac.id\n• Kunjungi langsung: Gedung FEB UNTAG Semarang\n\nKami juga menyediakan informasi mengenai skema pembayaran yang fleksibel.",
                'kategori'   => 'PMB',
                'urutan'     => 4,
            ],
            [
                'pertanyaan' => 'Apa saja konsentrasi (bidang kajian) yang tersedia?',
                'jawaban'    => "Program Doktor Manajemen PSMPD FEB UNTAG Semarang menawarkan beberapa konsentrasi, antara lain:\n\n• Manajemen Sumber Daya Manusia\n• Manajemen Pemasaran\n• Manajemen Keuangan\n• Manajemen Stratejik\n\nPilihan konsentrasi disesuaikan dengan minat penelitian dan latar belakang akademik mahasiswa. Konsultasikan dengan calon promotor untuk memilih konsentrasi yang paling sesuai.",
                'kategori'   => 'PMB',
                'urutan'     => 5,
            ],
            [
                'pertanyaan' => 'Kapan pendaftaran dibuka dan bagaimana alurnya?',
                'jawaban'    => "Pendaftaran PSMPD FEB UNTAG Semarang dibuka setiap tahun. Alur pendaftaran:\n\n1. Mengisi formulir pendaftaran online atau datang langsung ke sekretariat\n2. Menyerahkan dokumen persyaratan\n3. Membayar biaya pendaftaran\n4. Mengikuti tes seleksi (wawancara akademik dan presentasi proposal)\n5. Pengumuman hasil seleksi\n6. Registrasi ulang dan pembayaran SPP\n\nLihat jadwal lengkap di halaman Jadwal PMB. Untuk informasi terkini, hubungi sekretariat kami.",
                'kategori'   => 'PMB',
                'urutan'     => 6,
            ],
            [
                'pertanyaan' => 'Apakah ada beasiswa atau keringanan biaya?',
                'jawaban'    => "PSMPD FEB UNTAG Semarang membuka peluang beasiswa dan keringanan biaya bagi calon mahasiswa berprestasi. Informasi beasiswa dapat meliputi:\n\n• Beasiswa prestasi akademik (IPK S2 ≥ 3,75)\n• Keringanan biaya bagi dosen aktif UNTAG\n• Beasiswa dari Kemendikbudristek (BPPDN/BUDI DN)\n• Beasiswa dari lembaga mitra\n\nSilakan tanyakan langsung ke sekretariat PSMPD untuk informasi beasiswa yang sedang tersedia pada periode Anda mendaftar.",
                'kategori'   => 'PMB',
                'urutan'     => 7,
            ],
            [
                'pertanyaan' => 'Siapa saja dosen pembimbing (promotor) yang tersedia?',
                'jawaban'    => "Program Doktor Manajemen PSMPD FEB UNTAG Semarang memiliki promotor yang merupakan Guru Besar dan Doktor berpengalaman di bidang manajemen. Setiap mahasiswa akan dibimbing oleh:\n\n• 1 Promotor (Guru Besar / Prof.)\n• 1–2 Ko-Promotor\n\nDaftar lengkap dosen dan bidang keahlian dapat dilihat di halaman Dosen pada website ini. Penugasan promotor dilakukan setelah mahasiswa dinyatakan diterima dan menyesuaikan dengan topik penelitian.",
                'kategori'   => 'PMB',
                'urutan'     => 8,
            ],
            [
                'pertanyaan' => 'Apa keluaran (output) dari Program Doktor ini?',
                'jawaban'    => "Lulusan PSMPD FEB UNTAG Semarang diharapkan menghasilkan:\n\n• Disertasi ilmiah yang original dan berkontribusi pada keilmuan manajemen\n• Minimal 1 artikel terindeks Scopus atau jurnal internasional bereputasi\n• Gelar akademik: Doktor (Dr.) di bidang Manajemen\n\nKompetensi lulusan meliputi kemampuan penelitian mandiri, kepemimpinan akademik, dan kemampuan mengaplikasikan ilmu manajemen untuk memecahkan masalah nyata.",
                'kategori'   => 'PMB',
                'urutan'     => 9,
            ],
            [
                'pertanyaan' => 'Bagaimana cara menghubungi sekretariat PSMPD untuk informasi lebih lanjut?',
                'jawaban'    => "Anda dapat menghubungi Sekretariat PSMPD FEB UNTAG Semarang melalui:\n\n📞 Telepon: tercantum di halaman Kontak website ini\n💬 WhatsApp: klik tombol \"Konsultasi WA\" di pojok kanan bawah halaman ini\n📧 Email: psmpd@untag-smg.ac.id\n🏢 Alamat: Fakultas Ekonomi dan Bisnis, Universitas 17 Agustus 1945 Semarang, Jl. Pawiyatan Luhur IV No.1, Semarang\n\nTim kami siap membantu Anda setiap hari kerja, Senin–Jumat pukul 08.00–16.00 WIB.",
                'kategori'   => 'PMB',
                'urutan'     => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')->updateOrInsert(
                ['pertanyaan' => $faq['pertanyaan']],
                array_merge($faq, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    public function down(): void
    {
        DB::table('faqs')->where('kategori', 'PMB')->delete();
    }
};
