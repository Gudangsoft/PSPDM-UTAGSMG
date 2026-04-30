@extends('layouts.admin')
@section('title', 'Sambutan Ketua Program Studi')
@section('page-title', 'Sambutan Ketua Program Studi')

@section('styles')
<style>
#foto-preview-area img,
#foto-preview-area .foto-placeholder {
    width: 160px; height: 200px; object-fit: cover;
    border-radius: 14px; display: block;
}
#foto-preview-area .foto-placeholder {
    background: linear-gradient(135deg, #C0304A, #952035);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 3rem;
}
.sambutan-preview {
    background: #f8f9fa; border-radius: 14px; padding: 24px;
    border-left: 4px solid #C0304A; font-size: .9rem; color: #444;
    line-height: 1.75; white-space: pre-line;
}
</style>
@endsection

@section('content')

<div class="row g-4">

    {{-- FORM --}}
    <div class="col-lg-8">
        <form action="{{ route('admin.sambutan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul Seksi --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-type-h2 me-2"></i>Judul & Label Seksi Sambutan</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Label Badge / Chip</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-quote-fill text-danger"></i></span>
                                <input type="text" name="sambutan_chip" class="form-control"
                                       value="{{ old('sambutan_chip', $site['sambutan_chip']->value ?? 'Sambutan Ketua Program Studi') }}"
                                       placeholder="Sambutan Ketua Program Studi">
                            </div>
                            <small class="text-muted">Teks label kecil di atas judul seksi.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Judul Seksi (prefix h2)</label>
                            <div class="input-group">
                                <input type="text" name="sambutan_judul" class="form-control"
                                       value="{{ old('sambutan_judul', $site['sambutan_judul']->value ?? 'Selamat Datang di') }}"
                                       placeholder="Selamat Datang di">
                                <span class="input-group-text text-danger fw-bold">{{ $site['singkatan']->value ?? 'PSMPD' }}</span>
                            </div>
                            <small class="text-muted">Judul diikuti singkatan prodi otomatis.</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Identitas --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-person-badge me-2"></i>Identitas Ketua Program Studi</div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="sambutan_nama" class="form-control"
                                   value="{{ old('sambutan_nama', $site['sambutan_nama']->value ?? '') }}"
                                   placeholder="Prof. Dr. ..." required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="sambutan_jabatan" class="form-control"
                                   value="{{ old('sambutan_jabatan', $site['sambutan_jabatan']->value ?? 'Ketua Program Studi') }}"
                                   placeholder="Ketua Program Studi" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Isi Sambutan --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-chat-quote me-2"></i>Isi Sambutan</div>
                <div class="card-body p-4">
                    <label class="form-label">Teks Sambutan <span class="text-danger">*</span></label>
                    <textarea name="sambutan_isi" id="sambutan_isi" rows="10" class="form-control"
                              placeholder="Tuliskan sambutan Ketua Program Studi di sini..." required>{{ old('sambutan_isi', $site['sambutan_isi']->value ?? '') }}</textarea>
                    <small class="text-muted">Gunakan baris baru untuk membuat paragraf. Teks ini ditampilkan di halaman utama dan halaman Struktur Organisasi.</small>
                </div>
            </div>

            {{-- Foto --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-image me-2"></i>Foto Ketua Program Studi</div>
                <div class="card-body p-4">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div id="foto-preview-area">
                                @php $fotoVal = $site['sambutan_foto']->value ?? ''; @endphp
                                @if($fotoVal)
                                    <img src="{{ asset('storage/'.$fotoVal) }}" alt="Foto" id="foto-preview">
                                @else
                                    <div class="foto-placeholder" id="foto-placeholder">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Upload Foto Baru</label>
                            <input type="file" name="sambutan_foto" id="foto-input" class="form-control"
                                   accept="image/png,image/jpeg,image/jpg,image/webp">
                            <small class="text-muted d-block mt-1">PNG/JPG/WEBP, maks 2MB. Rasio 4:5 atau 3:4 (portrait) direkomendasikan.</small>

                            @if($fotoVal)
                            <form action="{{ route('admin.sambutan.destroyFoto') }}" method="POST" class="d-inline mt-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-2 mt-2"
                                        onclick="return confirm('Hapus foto ini?')">
                                    <i class="bi bi-trash me-1"></i>Hapus Foto
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Simpan Sambutan
                </button>
                <a href="{{ route('struktur') }}" target="_blank" class="btn btn-outline-secondary rounded-2">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di Website
                </a>
            </div>
        </form>
    </div>

    {{-- PREVIEW --}}
    <div class="col-lg-4">
        <div class="admin-card card mb-4">
            <div class="card-header"><i class="bi bi-eye me-2"></i>Preview Sambutan</div>
            <div class="card-body p-4">
                <div class="text-center mb-3">
                    @if($fotoVal)
                        <img src="{{ asset('storage/'.$fotoVal) }}" alt="Preview"
                             style="width:90px;height:110px;object-fit:cover;border-radius:12px;box-shadow:0 4px 15px rgba(139,0,0,0.2);">
                    @else
                        <div style="width:90px;height:110px;border-radius:12px;background:linear-gradient(135deg,#C0304A,#952035);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem;margin:0 auto;box-shadow:0 4px 15px rgba(139,0,0,0.2);">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    @endif
                </div>
                <div id="preview-isi" class="sambutan-preview">{{ $site['sambutan_isi']->value ?? '(Isi sambutan belum diisi)' }}</div>
                <div class="mt-3 pt-3 border-top" style="font-size:.85rem;">
                    <p class="fw-bold mb-0" id="preview-nama" style="color:#1a1a2e;">{{ $site['sambutan_nama']->value ?? '—' }}</p>
                    <p class="mb-0" id="preview-jabatan" style="color:#C0304A; font-weight:600; font-size:.82rem;">{{ $site['sambutan_jabatan']->value ?? 'Ketua Program Studi' }}</p>
                    <p class="text-muted mb-0" style="font-size:.78rem;">{{ $site['nama_prodi']->value ?? 'Program Studi Manajemen Program Doktor' }}</p>
                </div>
            </div>
        </div>

        <div class="admin-card card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2 text-primary"></i>Tampil di:</h6>
                <ul class="list-unstyled mb-0" style="font-size:.85rem; color:#555;">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Halaman Utama (beranda) — di atas Konsentrasi</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Halaman Struktur Organisasi</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
// Live preview foto
document.getElementById('foto-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const area = document.getElementById('foto-preview-area');
        area.innerHTML = '<img src="' + e.target.result + '" alt="Preview" id="foto-preview" style="width:160px;height:200px;object-fit:cover;border-radius:14px;">';
    };
    reader.readAsDataURL(file);
});

// Live preview teks & nama/jabatan
const isiEl = document.getElementById('sambutan_isi');
const previewIsi = document.getElementById('preview-isi');
if (isiEl) isiEl.addEventListener('input', () => { previewIsi.textContent = isiEl.value || '(Isi sambutan belum diisi)'; });

document.querySelector('[name="sambutan_nama"]').addEventListener('input', function () {
    document.getElementById('preview-nama').textContent = this.value || '—';
});
document.querySelector('[name="sambutan_jabatan"]').addEventListener('input', function () {
    document.getElementById('preview-jabatan').textContent = this.value || 'Ketua Program Studi';
});
</script>
@endsection
