<?php

namespace App\Http\Controllers;

use App\Mail\KontakMasuk;
use App\Models\PesanKontak;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function index()
    {
        $this->regenerateCaptcha();
        return view('kontak');
    }

    public function store(Request $request)
    {
        // ── Honeypot: field "website" harus kosong (manusia tidak isi) ──
        if ($request->filled('website')) {
            // Bot terdeteksi — pura-pura sukses tanpa simpan
            return back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
        }

        // ── Validasi input ──────────────────────────────────────────────
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email:rfc|max:100',
            'telepon' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s().]*$/'],
            'subjek'  => 'required|string|max:200',
            'pesan'   => 'required|string|max:2000',
            'captcha' => 'required|numeric',
        ], [
            'nama.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'subjek.required'  => 'Subjek wajib diisi.',
            'pesan.required'   => 'Pesan wajib diisi.',
            'captcha.required' => 'Jawaban verifikasi wajib diisi.',
            'captcha.numeric'  => 'Jawaban verifikasi harus berupa angka.',
            'telepon.regex'    => 'Format nomor telepon tidak valid (hanya angka, +, -, spasi).',
        ]);

        // ── Verifikasi CAPTCHA ──────────────────────────────────────────
        if ((int) $request->input('captcha') !== (int) session('captcha_ans')) {
            $this->regenerateCaptcha();
            return back()
                ->withErrors(['captcha' => 'Jawaban verifikasi salah. Silakan coba lagi.'])
                ->withInput();
        }

        // ── Simpan ke database ──────────────────────────────────────────
        $pesanData = collect($validated)->except('captcha')->toArray();
        PesanKontak::create($pesanData);

        // ── Kirim notifikasi email ke admin ─────────────────────────────
        try {
            $adminEmail = Setting::get('email', config('mail.from.address'));
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new KontakMasuk($pesanData));
            }
        } catch (\Throwable $e) {
            Log::warning('Notifikasi email kontak gagal: ' . $e->getMessage());
        }

        $this->regenerateCaptcha();

        return back()->with('success', 'Pesan Anda telah berhasil dikirim! Kami akan menghubungi Anda dalam 1×24 jam kerja.');
    }

    private function regenerateCaptcha(): void
    {
        $a = rand(2, 15);
        $b = rand(1, 10);
        session(['captcha_a' => $a, 'captcha_b' => $b, 'captcha_ans' => $a + $b]);
    }
}
