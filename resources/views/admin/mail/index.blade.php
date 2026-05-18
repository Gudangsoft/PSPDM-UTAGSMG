@extends('layouts.admin')
@section('title', 'Kirim Email')
@section('page-title', 'Kirim Email')
@section('content')

@if(session('mail_result'))
@php $r = session('mail_result'); @endphp
<div class="alert alert-{{ $r['gagal'] === 0 ? 'success' : 'warning' }} alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-{{ $r['gagal'] === 0 ? 'check-circle' : 'exclamation-triangle' }} me-2"></i>
    <strong>Berhasil terkirim: {{ $r['berhasil'] }} dari {{ $r['total'] }} email.</strong>
    @if($r['gagal']) &bull; Gagal: {{ $r['gagal'] }} (periksa konfigurasi SMTP). @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header fw-bold"><i class="bi bi-envelope-paper me-2 text-primary"></i>Compose Email</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.mail.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Penerima</label>
                        <textarea name="penerima" rows="4" class="form-control @error('penerima') is-invalid @enderror font-monospace"
                                  placeholder="Satu alamat email per baris:&#10;mahasiswa@email.com&#10;dosen@feb.ac.id">{{ old('penerima') }}</textarea>
                        <small class="text-muted">Satu email per baris. Email tidak valid akan diabaikan.</small>
                        @error('penerima')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subjek <span class="text-danger">*</span></label>
                        <input type="text" name="subjek" class="form-control @error('subjek') is-invalid @enderror"
                               value="{{ old('subjek') }}" placeholder="Subjek email...">
                        @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Isi Pesan <span class="text-danger">*</span></label>
                        <div class="border rounded-3 overflow-hidden">
                            <div class="bg-light border-bottom px-3 py-2 d-flex gap-2" style="font-size:.82rem;">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="wrapTag('b')"><b>B</b></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="wrapTag('i')"><i>I</i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="wrapTag('u')"><u>U</u></button>
                                <span class="text-muted ms-2 align-self-center">HTML diperbolehkan</span>
                            </div>
                            <textarea name="pesan" id="emailBody" rows="12" class="form-control border-0 rounded-0 @error('pesan') is-invalid @enderror"
                                      placeholder="<p>Yth. Bapak/Ibu...</p>&#10;<p>Isi pesan di sini.</p>"
                                      style="resize:vertical;">{{ old('pesan') }}</textarea>
                        </div>
                        @error('pesan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send me-2"></i>Kirim Email
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card card mb-3">
            <div class="card-header fw-bold">Konfigurasi SMTP</div>
            <div class="card-body p-3" style="font-size:.82rem; color:#555;">
                <p class="mb-2">Pastikan konfigurasi SMTP sudah diatur di file <code>.env</code>:</p>
                <pre class="bg-light rounded p-2 mb-2" style="font-size:.75rem; color:#333;">MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=app_password
MAIL_ENCRYPTION=tls</pre>
                <p class="mb-0 text-muted">Untuk Gmail, gunakan <strong>App Password</strong> (bukan password biasa).</p>
            </div>
        </div>

        <div class="admin-card card">
            <div class="card-header fw-bold">Tips</div>
            <div class="card-body p-3" style="font-size:.82rem; color:#555; line-height:1.7;">
                <p class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>Email dikirim satu per satu</p>
                <p class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>HTML diperbolehkan dalam isi pesan</p>
                <p class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>Pengirim dari setting "Email" di Pengaturan</p>
                <p class="mb-0"><i class="bi bi-exclamation-triangle text-warning me-1"></i>Batas wajar: 50-100 email/hari (Gmail free)</p>
            </div>
        </div>
    </div>
</div>

<script>
function wrapTag(tag) {
    const el = document.getElementById('emailBody');
    const start = el.selectionStart, end = el.selectionEnd;
    const sel = el.value.substring(start, end);
    el.setRangeText(`<${tag}>${sel}</${tag}>`, start, end, 'end');
    el.focus();
}
</script>
@endsection
