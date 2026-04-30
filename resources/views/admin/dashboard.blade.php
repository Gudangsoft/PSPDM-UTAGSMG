@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['berita'] }}</div>
                    <div class="stat-label">Total Berita</div>
                </div>
                <div class="stat-icon" style="background:#fff5f5; color:var(--red);">
                    <i class="bi bi-newspaper"></i>
                </div>
            </div>
            <i class="bi bi-newspaper stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['pengumuman'] }}</div>
                    <div class="stat-label">Pengumuman</div>
                </div>
                <div class="stat-icon" style="background:#fff8e1; color:#c8a84b;">
                    <i class="bi bi-bell"></i>
                </div>
            </div>
            <i class="bi bi-bell stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['dosen'] }}</div>
                    <div class="stat-label">Dosen & Staf</div>
                </div>
                <div class="stat-icon" style="background:#f0f4ff; color:#1a1a2e;">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <i class="bi bi-people stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['galeri'] }}</div>
                    <div class="stat-label">Foto Galeri</div>
                </div>
                <div class="stat-icon" style="background:#f0fff4; color:#2c7a4b;">
                    <i class="bi bi-images"></i>
                </div>
            </div>
            <i class="bi bi-images stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['pesan'] }}</div>
                    <div class="stat-label">Total Pesan</div>
                </div>
                <div class="stat-icon" style="background:#fef3f2; color:#c0304a;">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <i class="bi bi-envelope stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value text-danger">{{ $stats['pesan_baru'] }}</div>
                    <div class="stat-label">Pesan Belum Dibaca</div>
                </div>
                <div class="stat-icon" style="background:#fff5f5; color:var(--red);">
                    <i class="bi bi-envelope-exclamation"></i>
                </div>
            </div>
            <i class="bi bi-envelope-exclamation stat-bg-icon"></i>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Berita Terbaru --}}
    <div class="col-lg-7">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-newspaper me-2 text-danger"></i>Berita Terbaru</span>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-admin-primary btn-sm">
                    <i class="bi bi-plus me-1"></i>Tambah
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita_terbaru as $b)
                        <tr>
                            <td>
                                <a href="{{ route('admin.berita.edit', $b) }}" class="text-decoration-none fw-600" style="font-weight:600; color:#333;">
                                    {{ Str::limit($b->judul, 45) }}
                                </a>
                            </td>
                            <td><span class="badge rounded-pill" style="background:#fff5f5; color:var(--red); font-size:.75rem;">{{ $b->kategori }}</span></td>
                            <td>
                                @if($b->is_published)
                                    <span class="badge bg-success rounded-pill" style="font-size:.72rem;">Terbit</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill" style="font-size:.72rem;">Draft</span>
                                @endif
                            </td>
                            <td style="font-size:.8rem; color:#888;">{{ $b->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada berita</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pesan Terbaru --}}
    <div class="col-lg-5">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope me-2 text-danger"></i>Pesan Terbaru</span>
                <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:.78rem;">Semua</a>
            </div>
            <div class="card-body p-0">
                @forelse($pesan_terbaru as $p)
                <a href="{{ route('admin.pesan.show', $p) }}" class="d-flex gap-3 p-3 border-bottom text-decoration-none {{ !$p->is_read ? 'bg-light' : '' }}">
                    <div style="width:38px; height:38px; background:{{ !$p->is_read ? 'var(--red)' : '#e9ecef' }}; border-radius:50%; display:flex; align-items:center; justify-content:center; color:{{ !$p->is_read ? 'white' : '#666' }}; font-weight:700; font-size:.9rem; flex-shrink:0;">
                        {{ strtoupper(substr($p->nama, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1 min-w-0">
                        <div style="font-size:.84rem; font-weight:{{ !$p->is_read ? '700' : '500' }}; color:#333; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $p->nama }}</div>
                        <div style="font-size:.78rem; color:#888; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $p->subjek }}</div>
                    </div>
                    <small style="color:#bbb; font-size:.72rem; flex-shrink:0;">{{ $p->created_at->diffForHumans() }}</small>
                </a>
                @empty
                <p class="text-center text-muted p-4 mb-0" style="font-size:.875rem;">Belum ada pesan masuk</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-lightning me-2 text-danger"></i>Aksi Cepat</div>
            <div class="card-body p-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-admin-primary btn-sm"><i class="bi bi-plus me-1"></i>Berita Baru</a>
                    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-sm" style="background:#fff8e1; color:#c8a84b; border:none; border-radius:10px; font-weight:600;"><i class="bi bi-plus me-1"></i>Pengumuman</a>
                    <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm" style="background:#f0f4ff; color:#1a1a2e; border:none; border-radius:10px; font-weight:600;"><i class="bi bi-plus me-1"></i>Upload Foto</a>
                    <a href="{{ route('admin.dosen.create') }}" class="btn btn-sm" style="background:#f0fff4; color:#2c7a4b; border:none; border-radius:10px; font-weight:600;"><i class="bi bi-plus me-1"></i>Tambah Dosen</a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-secondary rounded-2"><i class="bi bi-gear me-1"></i>Pengaturan</a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-2"><i class="bi bi-box-arrow-up-right me-1"></i>Lihat Website</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
