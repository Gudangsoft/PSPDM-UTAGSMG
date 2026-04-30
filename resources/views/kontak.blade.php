@extends('layouts.app')
@section('title', 'Kontak - PSMPD-FEB UNTAG Semarang')
@section('content')

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
            {{-- Info Kontak --}}
            <div class="col-lg-5">
                <h3 style="font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:8px;">Informasi Kontak</h3>
                <p class="text-muted mb-4">Kami siap membantu Anda. Silakan hubungi kami melalui saluran berikut atau kirim pesan.</p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px; height:44px; background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="bi bi-geo-alt-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:0.875rem; color:var(--dark); margin-bottom:2px;">Alamat</div>
                            <div class="text-muted" style="font-size:0.82rem; line-height:1.6;">Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur,<br>Semarang 50233, Jawa Tengah</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px; height:44px; background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="bi bi-telephone-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:0.875rem; color:var(--dark); margin-bottom:2px;">Telepon</div>
                            <div class="text-muted" style="font-size:0.82rem;">(024) 8316405</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px; height:44px; background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="bi bi-envelope-fill text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:0.875rem; color:var(--dark); margin-bottom:2px;">Email</div>
                            <div class="text-muted" style="font-size:0.82rem;">psmpd@untag-smg.ac.id</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 p-3 bg-white rounded-3 shadow-sm">
                        <div style="width:44px; height:44px; background:#25D366; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="bi bi-whatsapp text-white"></i>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:0.875rem; color:var(--dark); margin-bottom:2px;">WhatsApp</div>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-muted" style="font-size:0.82rem; text-decoration:none;">+62 812-3456-7890</a>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 rounded-3" style="background:#fff5f5;">
                    <h6 style="font-weight:700; color:var(--dark); font-size:0.875rem; margin-bottom:8px;"><i class="bi bi-clock me-2 text-danger"></i>Jam Layanan</h6>
                    <div style="font-size:0.82rem; color:#555; line-height:1.8;">
                        Senin – Jumat: 08.00 – 16.00 WIB<br>
                        Sabtu: 08.00 – 12.00 WIB<br>
                        Minggu & Libur Nasional: Tutup
                    </div>
                </div>
            </div>

            {{-- Form Kontak --}}
            <div class="col-lg-7">
                @if(session('success'))
                <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4" style="background:#f0fff4;">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>{{ session('success') }}
                </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 style="font-weight:700; color:var(--dark); margin-bottom:20px;"><i class="bi bi-chat-left-dots me-2 text-danger"></i>Kirim Pesan</h4>
                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600;">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Anda">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600;">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600;">Nomor Telepon</label>
                                <input type="text" name="telepon" class="form-control rounded-3" value="{{ old('telepon') }}" placeholder="+62...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600;">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subjek" class="form-control rounded-3 @error('subjek') is-invalid @enderror" value="{{ old('subjek') }}" placeholder="Subjek pesan Anda">
                                @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600;">Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" rows="5" class="form-control rounded-3 @error('pesan') is-invalid @enderror" placeholder="Tuliskan pesan Anda di sini...">{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
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
        <div class="mt-5 rounded-4 overflow-hidden shadow-sm" style="height:350px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0757498698433!2d110.39427931477315!3d-6.983895694983789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c2a1b5dd6c7%3A0x5f39f4a8c6d5c7b!2sUniversitas%2017%20Agustus%201945%20Semarang!5e0!3m2!1sid!2sid!4v1640000000000!5m2!1sid!2sid"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<style>
.form-control:focus { border-color:var(--red-primary); box-shadow:0 0 0 .2rem rgba(192,48,74,.1); }
</style>
@endsection
