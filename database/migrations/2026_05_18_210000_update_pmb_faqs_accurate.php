<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus FAQ PMB lama
        DB::table('faqs')->where('kategori', 'PMB')->delete();

        $faqs = [
            [
                'urutan'     => 1,
                'pertanyaan' => 'Apa saja dokumen yang harus disiapkan untuk mendaftar?',
                'jawaban'    => "Calon mahasiswa wajib menyiapkan 14 dokumen berikut:\n\n1. Salinan KTP yang masih berlaku\n2. Ijazah dan transkrip nilai S1 yang telah dilegalisir\n3. Ijazah dan transkrip nilai S2 yang telah dilegalisir\n4. IPK jenjang Magister minimal 3,00 (skala 4,00)\n5. Sertifikat TPA dengan skor minimal 500 (berlaku maks. 2 tahun)\n6. Sertifikat TOEFL ITP minimal 525 atau IELTS minimal 6,0 (berlaku maks. 2 tahun)\n7. Dua surat rekomendasi dari tokoh akademik atau profesional\n8. Surat keterangan sumber dan jaminan pembiayaan\n9. Surat keterangan sehat dari instansi berwenang (termasuk bebas narkoba)\n10. Surat izin dari pimpinan instansi (bagi karyawan aktif)\n11. Pas foto berwarna berlatar biru ukuran 3×4 dan 4×6 (masing-masing 3 lembar)\n12. CV lengkap: riwayat pendidikan, pengalaman kerja, dan akademik\n13. Bukti publikasi ilmiah (jika ada: jurnal, prosiding, atau karya ilmiah lainnya)\n14. Proposal disertasi: mencakup topik, latar belakang, tujuan, dan metodologi penelitian\n\nSeluruh dokumen wajib dilengkapi dengan surat pernyataan bermeterai yang menyatakan keaslian dokumen.",
            ],
            [
                'urutan'     => 2,
                'pertanyaan' => 'Berapa IPK minimal yang disyaratkan untuk mendaftar?',
                'jawaban'    => "IPK jenjang Magister (S2) minimal 3,00 pada skala 0–4,00.\n\nPastikan transkrip nilai S2 Anda sudah dilegalisir oleh perguruan tinggi asal sebelum diserahkan.",
            ],
            [
                'urutan'     => 3,
                'pertanyaan' => 'Apa persyaratan kemampuan bahasa Inggris?',
                'jawaban'    => "Calon mahasiswa wajib melampirkan salah satu sertifikat berikut:\n\n• TOEFL ITP dengan skor minimal 525\n• IELTS dengan skor minimal 6,0\n\nSertifikat harus masih berlaku (tidak lebih dari 2 tahun). Jika belum memiliki, segera ikuti tes di lembaga resmi sebelum pendaftaran.",
            ],
            [
                'urutan'     => 4,
                'pertanyaan' => 'Apa itu TPA dan berapa skor minimalnya?',
                'jawaban'    => "TPA (Tes Potensi Akademik) adalah tes yang mengukur kemampuan akademik calon mahasiswa.\n\nSkor minimal TPA yang disyaratkan adalah 500, dengan masa berlaku sertifikat maksimal 2 tahun.\n\nTPA dapat ditempuh melalui lembaga penyelenggara resmi seperti BAPPENAS atau OTO Bappenas.",
            ],
            [
                'urutan'     => 5,
                'pertanyaan' => 'Berapa biaya pendaftaran dan bagaimana cara membayarnya?',
                'jawaban'    => "Biaya Pendaftaran: Rp 1.000.000,- (Satu Juta Rupiah)\n\nPembayaran dilakukan melalui transfer ke:\n🏦 Bank: BTN\n📋 No. Rekening: 0057101390000046\n👤 Atas Nama: FEB UNTAG SEMARANG\n\nSimpan bukti transfer dan sertakan saat proses pendaftaran.",
            ],
            [
                'urutan'     => 6,
                'pertanyaan' => 'Seperti apa proposal disertasi yang harus disiapkan?',
                'jawaban'    => "Proposal disertasi merupakan gambaran awal rencana penelitian Anda. Proposal minimal harus mencakup:\n\n• Topik/Judul penelitian\n• Latar belakang masalah\n• Tujuan penelitian\n• Metodologi penelitian yang akan digunakan\n\nProposal tidak harus panjang, namun harus menunjukkan keseriusan dan arah penelitian yang jelas. Anda dapat berkonsultasi dengan calon promotor setelah dinyatakan diterima.",
            ],
            [
                'urutan'     => 7,
                'pertanyaan' => 'Apakah karyawan aktif bisa mendaftar? Dokumen apa yang diperlukan?',
                'jawaban'    => "Ya, karyawan aktif sangat diperbolehkan mendaftar. Program Doktor Manajemen PSMPD FEB UNTAG Semarang memang dirancang untuk profesional yang masih aktif bekerja.\n\nBagi karyawan aktif, wajib melampirkan:\n• Surat izin dari pimpinan instansi/perusahaan tempat bekerja\n\nSurat ini menunjukkan bahwa pimpinan mengetahui dan menyetujui Anda menempuh studi doktor.",
            ],
            [
                'urutan'     => 8,
                'pertanyaan' => 'Apa itu surat jaminan pembiayaan?',
                'jawaban'    => "Surat keterangan resmi yang menyatakan sumber dan jaminan pembiayaan studi Anda selama menempuh Program Doktor.\n\nSurat ini dapat berupa:\n• Surat dari instansi/perusahaan yang menanggung biaya studi\n• Surat pernyataan mandiri (jika biaya ditanggung sendiri)\n• Surat dari sponsor/lembaga pemberi beasiswa\n\nTujuannya untuk memastikan mahasiswa dapat menyelesaikan studi hingga selesai.",
            ],
            [
                'urutan'     => 9,
                'pertanyaan' => 'Pendaftaran gelombang berapa yang sedang dibuka?',
                'jawaban'    => "Saat ini sedang dibuka penerimaan Gelombang I Tahun Akademik 2025/2026.\n\nUntuk informasi jadwal pendaftaran selengkapnya — termasuk batas akhir pengumpulan berkas dan jadwal seleksi — silakan lihat halaman Jadwal PMB di website ini atau hubungi sekretariat PSMPD.",
            ],
            [
                'urutan'     => 10,
                'pertanyaan' => 'Bagaimana cara menghubungi sekretariat PSMPD?',
                'jawaban'    => "Sekretariat PSMPD FEB UNTAG Semarang dapat dihubungi melalui:\n\n📱 WhatsApp / Telepon: 082319475792\n📧 Email: psmpd@untag-smg.ac.id\n🏢 Alamat: Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur, Semarang 50233\n\n⏰ Jam Layanan:\nSenin – Jumat: 08.00 – 16.00 WIB\nSabtu: 08.00 – 12.00 WIB\n\nAnda juga bisa klik tombol WhatsApp di pojok kanan bawah halaman ini untuk langsung berkonsultasi.",
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')->insert(array_merge($faq, [
                'kategori'   => 'PMB',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        DB::table('faqs')->where('kategori', 'PMB')->delete();
    }
};
