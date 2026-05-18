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

        {{-- Bulk Upload AJAX --}}
        <div class="admin-card card">
            <div class="card-header fw-bold">
                <i class="bi bi-cloud-upload me-2"></i>Upload Foto Massal
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Prefix Judul Foto</label>
                    <input type="text" id="judulPrefix" class="form-control"
                           value="{{ $album->nama }}" placeholder="cth: Wisuda 2025">
                    <small class="text-muted">Judul foto akan diberi nomor otomatis</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select id="kategoriSelect" class="form-select">
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
                    <input type="file" id="fotos" class="d-none" accept="image/*" multiple onchange="prepareFiles(this.files)">
                </div>

                {{-- File list --}}
                <div id="file-list" class="mb-3" style="display:none; max-height:220px; overflow-y:auto; border:1px solid #eee; border-radius:8px; padding:8px;"></div>

                {{-- Progress --}}
                <div id="progress-wrap" class="mb-3" style="display:none;">
                    <div class="d-flex justify-content-between mb-1" style="font-size:.82rem;">
                        <span id="progress-label">Mengupload...</span>
                        <span id="progress-count"></span>
                    </div>
                    <div class="progress" style="height:8px;">
                        <div id="progress-bar" class="progress-bar bg-danger" style="width:0%; transition:width .3s;"></div>
                    </div>
                </div>

                <button id="btnUpload" class="btn btn-admin-primary w-100" disabled onclick="startUpload()">
                    <i class="bi bi-upload me-2"></i>Upload Foto
                </button>
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
const UPLOAD_URL = '{{ route('admin.album.upload-one', $album) }}';
const CSRF       = '{{ csrf_token() }}';
let selectedFiles = [];

function prepareFiles(files) {
    selectedFiles = Array.from(files).filter(f => f.type.startsWith('image/'));
    const list = document.getElementById('file-list');
    const btn  = document.getElementById('btnUpload');
    if (!selectedFiles.length) { list.style.display = 'none'; btn.disabled = true; return; }
    list.style.display = '';
    list.innerHTML = selectedFiles.map((f, i) =>
        `<div id="fi-${i}" class="d-flex align-items-center gap-2 py-1 px-2" style="font-size:.82rem; border-bottom:1px solid #f0f0f0;">
            <i class="bi bi-image text-muted"></i>
            <span class="flex-fill text-truncate">${f.name}</span>
            <span class="text-muted">${(f.size/1024/1024).toFixed(1)} MB</span>
            <span id="st-${i}" class="badge bg-secondary" style="min-width:60px;">Antri</span>
        </div>`
    ).join('');
    btn.disabled = false;
    btn.innerHTML = `<i class="bi bi-upload me-2"></i>Upload ${selectedFiles.length} Foto`;
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropzone-bulk').style.borderColor = '#ddd';
    const dt    = new DataTransfer();
    Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/')).forEach(f => dt.items.add(f));
    document.getElementById('fotos').files = dt.files;
    prepareFiles(dt.files);
}

async function startUpload() {
    if (!selectedFiles.length) return;
    const btn      = document.getElementById('btnUpload');
    const wrap     = document.getElementById('progress-wrap');
    const bar      = document.getElementById('progress-bar');
    const label    = document.getElementById('progress-label');
    const counter  = document.getElementById('progress-count');
    const judul    = document.getElementById('judulPrefix').value || '{{ $album->nama }}';
    const kategori = document.getElementById('kategoriSelect').value;

    btn.disabled = true;
    wrap.style.display = '';
    let done = 0, failed = 0;

    for (let i = 0; i < selectedFiles.length; i++) {
        document.getElementById(`st-${i}`).className = 'badge bg-warning text-dark';
        document.getElementById(`st-${i}`).textContent = 'Upload...';

        const fd = new FormData();
        fd.append('_token', CSRF);
        fd.append('foto', selectedFiles[i]);
        fd.append('judul', judul + ' ' + (i + 1));
        fd.append('kategori', kategori);

        try {
            const res  = await fetch(UPLOAD_URL, { method: 'POST', body: fd });
            const json = await res.json();
            if (json.ok) {
                done++;
                document.getElementById(`st-${i}`).className = 'badge bg-success';
                document.getElementById(`st-${i}`).textContent = 'OK';
            } else {
                throw new Error(json.error || 'Gagal');
            }
        } catch (err) {
            failed++;
            document.getElementById(`st-${i}`).className = 'badge bg-danger';
            document.getElementById(`st-${i}`).textContent = 'Gagal';
        }

        const pct = Math.round(((i + 1) / selectedFiles.length) * 100);
        bar.style.width = pct + '%';
        counter.textContent = `${i + 1} / ${selectedFiles.length}`;
        label.textContent = `Mengupload foto ${i + 1}...`;
    }

    label.textContent = `Selesai: ${done} berhasil, ${failed} gagal.`;
    bar.style.width = '100%';
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Refresh Halaman';
    btn.onclick = () => location.reload();
}
</script>

@endsection
