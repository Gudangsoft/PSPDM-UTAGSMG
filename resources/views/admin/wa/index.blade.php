@extends('layouts.admin')
@section('title', 'WA Blaster')
@section('page-title', 'WA Blaster')
@section('content')

@if(session('wa_result'))
@php $r = session('wa_result'); @endphp
<div class="alert alert-{{ $r['gagal'] === 0 ? 'success' : 'warning' }} alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-{{ $r['gagal'] === 0 ? 'check-circle' : 'exclamation-triangle' }} me-2"></i>
    <strong>Terkirim: {{ $r['berhasil'] }}</strong>
    @if($r['gagal']) &bull; Gagal: {{ $r['gagal'] }} @endif
    @if(!empty($r['errors']))
    <ul class="mb-0 mt-1" style="font-size:.82rem;">@foreach($r['errors'] as $e)<li>{{ $e }}</li>@endforeach</ul>
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->has('api'))
<div class="alert alert-danger rounded-3 mb-4">
    <i class="bi bi-x-circle me-2"></i>{{ $errors->first('api') }}
    — <a href="{{ route('admin.settings.index') }}" class="alert-link">Konfigurasi di Pengaturan</a>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header fw-bold"><i class="bi bi-whatsapp text-success me-2"></i>Kirim Pesan WhatsApp</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.wa.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Daftar Nomor Tujuan</label>
                        <textarea name="nomor" rows="6" class="form-control @error('nomor') is-invalid @enderror font-monospace"
                                  placeholder="Satu nomor per baris:&#10;08123456789&#10;08987654321&#10;6281234567890">{{ old('nomor') }}</textarea>
                        <small class="text-muted">Format: 08xxx atau 628xxx, satu nomor per baris</small>
                        @error('nomor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pesan <span class="text-danger">*</span></label>
                        <textarea name="pesan" rows="8" class="form-control @error('pesan') is-invalid @enderror"
                                  placeholder="Ketik pesan WhatsApp di sini...&#10;&#10;Anda bisa gunakan *teks tebal*, _miring_, ~coret~">{{ old('pesan') }}</textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Mendukung format WhatsApp: *tebal*, _miring_</small>
                            <small class="text-muted" id="charCount">0 karakter</small>
                        </div>
                        @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-send me-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Status API --}}
        <div class="admin-card card mb-3">
            <div class="card-header fw-bold">Status API</div>
            <div class="card-body p-3">
                @if($apiKey && $apiSender)
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-success">Terhubung</span>
                    <span style="font-size:.82rem;">Fonnte API</span>
                </div>
                <div style="font-size:.8rem; color:#666;">
                    <i class="bi bi-phone me-1"></i>Pengirim: <strong>{{ $apiSender }}</strong>
                </div>
                @else
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-danger">Belum Dikonfigurasi</span>
                </div>
                <p style="font-size:.82rem; color:#666;" class="mb-2">Tambahkan API Key dan Nomor Pengirim di Pengaturan.</p>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-gear me-1"></i>Buka Pengaturan
                </a>
                @endif
            </div>
        </div>

        {{-- Panduan --}}
        <div class="admin-card card">
            <div class="card-header fw-bold">Panduan</div>
            <div class="card-body p-3" style="font-size:.82rem; color:#555; line-height:1.7;">
                <p class="mb-2"><strong>1.</strong> Daftar di <a href="https://fonnte.com" target="_blank">fonnte.com</a> untuk mendapatkan API Key</p>
                <p class="mb-2"><strong>2.</strong> Masukkan API Key & nomor WA pengirim di menu <strong>Pengaturan</strong></p>
                <p class="mb-2"><strong>3.</strong> Masukkan nomor tujuan (satu per baris) dan pesan</p>
                <p class="mb-0"><strong>4.</strong> Klik <em>Kirim Pesan</em></p>
            </div>
        </div>
    </div>
</div>

<script>
const textarea = document.querySelector('textarea[name="pesan"]');
const counter  = document.getElementById('charCount');
textarea?.addEventListener('input', () => counter.textContent = textarea.value.length + ' karakter');
</script>
@endsection
