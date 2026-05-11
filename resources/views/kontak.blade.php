@extends('layouts.app')
@section('title', 'Kontak - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')
@section('content')

@php
    $alamat   = $site['alamat']?->value   ?? 'Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur, Semarang 50233, Jawa Tengah';
    $telepon  = $site['telepon']?->value  ?? '(024) 8316405';
    $emailKtr = $site['email']?->value    ?? 'psmpd@untag-smg.ac.id';
    $waRaw    = $site['whatsapp']?->value ?? '';
    $waNum    = preg_replace('/\D/', '', $waRaw);
    $waUrl    = $waNum ? 'https://wa.me/' . $waNum : '#';
    $waLabel  = $waRaw ?: '+62 812-3456-7890';

    $captchaA = (int) session('captcha_a', 3);
    $captchaB = (int) session('captcha_b', 5);
@endphp

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-envelope me-2"></i>Hubungi Kami</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kontak</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="row g-5">

            {{-- ── Info Kontak ──────────────────────────────────────────────── --}}
            <div class="col-lg-5">
                <h3 style="font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:8px;">Informasi Kontak</h3>
                <p class="text-muted mb-4">Kami siap membantu Anda. Silakan hubungi kami melalui saluran berikut atau kirim pesan.</p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--red-primary),var(--red-dark));border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-geo-alt-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.875rem;color:var(--dark);margin-bottom:2px;">Alamat</div>
                            <div class="text-muted" style="font-size:0.82rem;line-height:1.6;">{{ $alamat }}</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--red-primary),var(--red-dark));border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-telephone-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.875rem;color:var(--dark);margin-bottom:2px;">Telepon</div>
                            <div class="text-muted" style="font-size:0.82rem;">
                                <a href="tel:{{ preg_replace('/[^0-9+]/','',$telepon) }}" class="text-muted text-decoration-none">{{ $telepon }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--red-primary),var(--red-dark));border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-envelope-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.875rem;color:var(--dark);margin-bottom:2px;">Email</div>
                            <div class="text-muted" style="font-size:0.82rem;">
                                <a href="mailto:{{ $emailKtr }}" class="text-muted text-decoration-none">{{ $emailKtr }}</a>
                            </div>
                        </div>
                    </div>

                    @if($waNum)
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px;height:44px;background:#25D366;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-whatsapp text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.875rem;color:var(--dark);margin-bottom:2px;">WhatsApp</div>
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="text-muted" style="font-size:0.82rem;text-decoration:none;">{{ $waLabel }}</a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-4 p-3 rounded-3" style="background:#fff5f5;">
                    <h6 style="font-weight:700;color:var(--dark);font-size:0.875rem;margin-bottom:8px;"><i class="bi bi-clock me-2 text-danger"></i>Jam Layanan</h6>
                    <div style="font-size:0.82rem;color:#555;line-height:1.8;">
                        Senin – Jumat: 08.00 – 16.00 WIB<br>
                        Sabtu: 08.00 – 12.00 WIB<br>
                        Minggu &amp; Libur Nasional: Tutup
                    </div>
                </div>
            </div>

            {{-- ── Form Kontak ──────────────────────────────────────────────── --}}
            <div class="col-lg-7">
                @if(session('success'))
                <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4 d-flex align-items-start gap-2" style="background:#f0fff4;">
                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 style="font-weight:700;color:var(--dark);margin-bottom:20px;"><i class="bi bi-chat-left-dots me-2 text-danger"></i>Kirim Pesan</h4>

                    <form action="{{ route('kontak.store') }}" method="POST" novalidate>
                        @csrf

                        {{-- Honeypot: disembunyikan via CSS, bukan hidden attribute --}}
                        <div style="position:absolute;left:-9999px;opacity:0;pointer-events:none;" aria-hidden="true" tabindex="-1">
                            <label for="website">Website (biarkan kosong)</label>
                            <input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                       class="form-control rounded-3 @error('nama') is-invalid @enderror"
                                       value="{{ old('nama') }}" placeholder="Nama Anda"
                                       maxlength="100" required autocomplete="name">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                       class="form-control rounded-3 @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="email@contoh.com"
                                       maxlength="100" required autocomplete="email">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">Nomor Telepon</label>
                                <input type="tel" name="telepon"
                                       class="form-control rounded-3 @error('telepon') is-invalid @enderror"
                                       value="{{ old('telepon') }}" placeholder="+62..."
                                       maxlength="20" autocomplete="tel">
                                @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subjek"
                                       class="form-control rounded-3 @error('subjek') is-invalid @enderror"
                                       value="{{ old('subjek') }}" placeholder="Subjek pesan Anda"
                                       maxlength="200" required>
                                @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" rows="5"
                                          class="form-control rounded-3 @error('pesan') is-invalid @enderror"
                                          placeholder="Tuliskan pesan Anda di sini..."
                                          maxlength="2000" required>{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- ── CAPTCHA Matematika ─────────────────────────────── --}}
                            <div class="col-12">
                                <label class="form-label" style="font-size:0.85rem;font-weight:600;">
                                    <i class="bi bi-shield-check me-1 text-danger"></i>Verifikasi Anti-Bot
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="captcha-box px-4 py-2 rounded-3 fw-bold"
                                         style="background:#fff5f5;border:2px solid var(--red-primary);color:var(--dark);font-size:1.1rem;letter-spacing:2px;white-space:nowrap;user-select:none;">
                                        {{ $captchaA }} + {{ $captchaB }} = ?
                                    </div>
                                    <input type="number" name="captcha"
                                           class="form-control rounded-3 @error('captcha') is-invalid @enderror"
                                           style="max-width:120px;"
                                           value="{{ old('captcha') }}"
                                           placeholder="Jawaban"
                                           min="0" max="99" required autocomplete="off">
                                    @error('captcha')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <small class="text-muted mt-1 d-block">Isi hasil penjumlahan di atas untuk membuktikan Anda bukan robot.</small>
                            </div>

                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Google Maps --}}
        @php $mapsUrl = $site['maps_embed']?->value ?? ''; @endphp
        @if($mapsUrl)
        <div class="mt-5 rounded-4 overflow-hidden shadow-sm" style="height:350px;">
            <iframe src="{{ $mapsUrl }}"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi {{ $site['nama_prodi']?->value ?? 'PSMPD' }} FEB UNTAG Semarang">
            </iframe>
        </div>
        @endif
    </div>
</section>

<style>
.form-control:focus { border-color:var(--red-primary); box-shadow:0 0 0 .2rem rgba(192,48,74,.1); }
</style>
@endsection
