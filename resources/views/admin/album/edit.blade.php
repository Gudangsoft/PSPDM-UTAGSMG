@extends('layouts.admin')
@section('title', 'Kelola Album: ' . $album->nama)
@section('page-title', 'Kelola Album')
@section('content')

<div class="mb-3">
    <a href="{{ route('admin.album.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Album
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">

    {{-- Info Album --}}
    <div class="col-lg-4">
        <div class="admin-card card mb-4">
            <div class="card-header fw-bold">Info Album</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.album.update', $album) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Album <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $album->nama) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $album->urutan) }}" min="0">
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                   id="is_active" {{ $album->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Album Aktif</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Bulk Upload --}}
        <div class="admin-card card">
            <div class="card-header fw-bold">
                <i class="bi bi-cloud-upload me-2"></i>Upload Foto Massal
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.album.bulk-upload', $album) }}" method="POST"
                      enctype="multipart/form-data" id="bulkForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Prefix Judul Foto</label>
                        <input type="text" name="judul_prefix" class="form-control"
                               value="{{ $album->nama }}" placeholder="cth: Wisuda 2025">
                        <small class="text-muted">Judul foto akan diberi nomor otomatis</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            @foreach(['Kegiatan','Wisuda','Seminar','Penelitian','Kampus','Umum'] as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto <span class="text-danger">*</span></label>
                        <div id="dropzone-bulk"
                             style="border:2px dashed #ddd; border-radius:12px; padding:24px; text-align:center; cursor:pointer; transition:border-color .2s;"
                             onclick="document.getElementById('fotos').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='#C0304A';"
                             ondragleave="this.style.borderColor='#ddd';"
                             ondrop="handleDrop(event)">
                            <i class="bi bi-images" style="font-size:2.5rem; color:#ddd;"></i>
                            <p class="text-muted mt-2 mb-0" style="font-size:.875rem;">Klik atau seret foto ke sini</p>
                            <small class="text-muted">Bisa pilih banyak foto sekaligus &bull; JPG/PNG/WebP</small>
                        </div>
                        <input type="file" name="fotos[]" id="fotos" class="d-none"
                               accept="image/*" multiple onchange="showPreviews(this.files)">
                    </div>

                    {{-- Preview grid --}}
                    <div id="preview-grid" class="row g-2 mb-3" style="display:none!important;"></div>
                    <div id="file-count" class="text-muted mb-3" style="font-size:.85rem; display:none;"></div>

                    <button type="submit" class="btn btn-admin-primary w-100" id="btnUpload" disabled>
                        <i class="bi bi-upload me-2"></i>Upload Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Foto dalam Album --}}
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Foto dalam Album</span>
                <span class="badge" style="background:#f0f4ff; color:#333;">{{ $fotos->total() }} foto</span>
            </div>
            <div class="card-body p-3">
                @if($fotos->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="bi bi-images" style="font-size:3rem; opacity:.3;"></i>
                    <p class="mt-3">Belum ada foto. Upload foto di panel kiri.</p>
                </div>
                @else
                <div class="row g-2">
                    @foreach($fotos as $foto)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="position-relative rounded-3 overflow-hidden"
                             style="aspect-ratio:4/3; background:#f5f5f5;">
                            <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}"
                                 style="width:100%; height:100%; object-fit:cover;">
                            {{-- Cover badge --}}
                            @if($album->cover_foto === $foto->gambar)
                            <div style="position:absolute; top:4px; left:4px;">
                                <span class="badge bg-warning text-dark" style="font-size:.65rem;">
                                    <i class="bi bi-star-fill me-1"></i>Cover
                                </span>
                            </div>
                            @endif
                            {{-- Actions overlay --}}
                            <div class="foto-actions position-absolute bottom-0 start-0 end-0 p-2 d-flex gap-1"
                                 style="background:linear-gradient(transparent,rgba(0,0,0,.7)); opacity:0; transition:opacity .2s;">
                                <form action="{{ route('admin.album.set-cover', [$album, $foto]) }}" method="POST" class="flex-fill">
                                    @csrf
                                    <button class="btn btn-sm btn-warning w-100" style="font-size:.7rem; padding:3px 6px;">
                                        <i class="bi bi-star"></i> Cover
                                    </button>
                                </form>
                                <form action="{{ route('admin.album.destroy-foto', [$album, $foto]) }}" method="POST"
                                      onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" style="font-size:.7rem; padding:3px 8px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="mt-1 mb-0 text-truncate" style="font-size:.72rem; color:#555;">{{ $foto->judul }}</p>
                    </div>
                    @endforeach
                </div>
                @if($fotos->hasPages())
                <div class="mt-3">{{ $fotos->links() }}</div>
                @endif
                @endif
            </div>
        </div>
    </div>

</div>

<style>
.foto-actions { opacity: 0; transition: opacity .2s; }
.col-6:hover .foto-actions,
.col-md-4:hover .foto-actions,
.col-lg-3:hover .foto-actions { opacity: 1 !important; }
</style>

<script>
function showPreviews(files) {
    const grid = document.getElementById('preview-grid');
    const count = document.getElementById('file-count');
    const btn   = document.getElementById('btnUpload');
    grid.innerHTML = '';
    if (!files.length) { grid.style.display = 'none'; count.style.display = 'none'; btn.disabled = true; return; }
    grid.style.display = '';
    count.style.display = '';
    count.textContent = files.length + ' foto dipilih';
    btn.disabled = false;
    Array.from(files).slice(0, 12).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const col = document.createElement('div');
            col.className = 'col-4 col-md-3';
            col.innerHTML = `<img src="${e.target.result}" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;">`;
            grid.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
    if (files.length > 12) {
        const col = document.createElement('div');
        col.className = 'col-4 col-md-3 d-flex align-items-center justify-content-center';
        col.innerHTML = `<span class="text-muted" style="font-size:.8rem;">+${files.length - 12} lagi</span>`;
        grid.appendChild(col);
    }
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropzone-bulk').style.borderColor = '#ddd';
    const input = document.getElementById('fotos');
    const dt = new DataTransfer();
    Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/')).forEach(f => dt.items.add(f));
    input.files = dt.files;
    showPreviews(input.files);
}

// Show progress on submit
document.getElementById('bulkForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnUpload');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengupload...';
});
</script>

@endsection
