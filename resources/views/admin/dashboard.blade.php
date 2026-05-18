@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ===================== ROW 1: STAT CARDS ===================== --}}
<div class="row g-3 mb-4">

    {{-- Berita --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #2563eb !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(37,99,235,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-newspaper" style="font-size:1.6rem; color:#2563eb;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalBerita }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">Berita Terbit</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Artikel dipublikasikan</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengumuman --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #0891b2 !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(8,145,178,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-bell-fill" style="font-size:1.6rem; color:#0891b2;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalPengumuman }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">Pengumuman</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Sedang aktif</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dosen --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #7c3aed !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(124,58,237,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-people-fill" style="font-size:1.6rem; color:#7c3aed;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalDosen }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">Dosen &amp; Staf</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Terdaftar di sistem</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Galeri --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #059669 !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(5,150,105,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-images" style="font-size:1.6rem; color:#059669;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalGaleri }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">Foto Galeri</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Koleksi foto</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Download --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #d97706 !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(217,119,6,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-download" style="font-size:1.6rem; color:#d97706;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalDownload }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">File Download</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Dokumen tersedia</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #0d9488 !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(13,148,136,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-question-circle-fill" style="font-size:1.6rem; color:#0d9488;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalFaq }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">FAQ</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Pertanyaan umum</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Agenda Mendatang --}}
    <div class="col-xl-3 col-md-6">
        <div class="admin-card card h-100 border-0" style="border-left:4px solid #ea580c !important; border-radius:14px;">
            <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                <div style="width:52px; height:52px; border-radius:14px; background:rgba(234,88,12,.12); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="bi bi-calendar-event-fill" style="font-size:1.6rem; color:#ea580c;"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:2rem; font-weight:800; line-height:1; color:#1e3a5f;">{{ $totalAgenda }}</div>
                    <div style="font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">Agenda</div>
                    <div style="font-size:.72rem; color:#9ca3af; margin-top:2px;">Kegiatan mendatang</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pesan Belum Dibaca --}}
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('admin.pesan.index') }}" class="text-decoration-none">
            <div class="admin-card card h-100 border-0" style="border-left:4px solid #C0304A !important; border-radius:14px; background:linear-gradient(135deg,#fff5f6,#fff);">
                <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                    <div style="width:52px; height:52px; border-radius:14px; background:rgba(192,48,74,.15); display:flex; align-items:center; justify-content:center; flex-shrink:0; position:relative;">
                        <i class="bi bi-envelope-exclamation-fill" style="font-size:1.6rem; color:#C0304A;"></i>
                        @if($pesanBelumDibaca > 0)
                        <span style="position:absolute; top:-4px; right:-4px; background:#C0304A; color:white; font-size:.6rem; font-weight:800; border-radius:50%; width:18px; height:18px; display:flex; align-items:center; justify-content:center;">{{ $pesanBelumDibaca > 9 ? '9+' : $pesanBelumDibaca }}</span>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div style="font-size:2rem; font-weight:800; line-height:1; color:#C0304A;">{{ $pesanBelumDibaca }}</div>
                        <div style="font-size:.8rem; font-weight:600; color:#9f1239; text-transform:uppercase; letter-spacing:.5px;">Pesan Baru</div>
                        <div style="font-size:.72rem; color:#f87171; margin-top:2px;">Belum dibaca &rarr;</div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>

{{-- ===================== ROW 2: BERITA + AGENDA ===================== --}}
<div class="row g-4 mb-4">

    {{-- Berita Terbaru --}}
    <div class="col-lg-8">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E); color:white; border-radius:12px 12px 0 0; border:none;">
                <span style="font-weight:700; font-size:.95rem;"><i class="bi bi-newspaper me-2"></i>Berita Terbaru</span>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2); color:white; border:1px solid rgba(255,255,255,.3); border-radius:8px; font-size:.78rem;">
                    <i class="bi bi-plus-lg me-1"></i>Tambah
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr style="background:#f9fafb;">
                            <th style="font-size:.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid #e5e7eb; padding:10px 16px;">Judul</th>
                            <th style="font-size:.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid #e5e7eb; padding:10px 16px;" class="d-none d-md-table-cell">Status</th>
                            <th style="font-size:.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid #e5e7eb; padding:10px 16px;" class="d-none d-lg-table-cell">Tanggal</th>
                            <th style="font-size:.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid #e5e7eb; padding:10px 16px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritaTerbaru as $b)
                        <tr style="border-bottom:1px solid #f3f4f6;" class="align-middle">
                            <td style="padding:12px 16px;">
                                <div style="font-weight:600; font-size:.875rem; color:#1f2937; line-height:1.4;">{{ Str::limit($b->judul, 50) }}</div>
                                <div style="font-size:.75rem; color:#9ca3af; margin-top:2px;">
                                    <span style="background:#f3f4f6; padding:1px 8px; border-radius:20px;">{{ $b->kategori }}</span>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell" style="padding:12px 16px;">
                                @if($b->is_published)
                                    <span class="badge" style="background:#dcfce7; color:#166534; border-radius:20px; font-size:.72rem; font-weight:600; padding:4px 10px;">
                                        <i class="bi bi-check-circle-fill me-1"></i>Terbit
                                    </span>
                                @else
                                    <span class="badge" style="background:#f3f4f6; color:#6b7280; border-radius:20px; font-size:.72rem; font-weight:600; padding:4px 10px;">
                                        <i class="bi bi-pencil me-1"></i>Draft
                                    </span>
                                @endif
                            </td>
                            <td class="d-none d-lg-table-cell" style="padding:12px 16px; font-size:.8rem; color:#9ca3af; white-space:nowrap;">
                                <i class="bi bi-clock me-1"></i>{{ $b->created_at->format('d M Y') }}
                            </td>
                            <td style="padding:12px 16px; text-align:center;">
                                <a href="{{ route('admin.berita.edit', $b) }}" class="btn btn-sm" style="background:#fff5f6; color:#C0304A; border:1px solid #fecdd3; border-radius:8px; font-size:.75rem;">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-newspaper" style="font-size:2.5rem; color:#e5e7eb;"></i>
                                <p style="color:#9ca3af; margin-top:8px; font-size:.875rem;">Belum ada berita</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer" style="background:#f9fafb; border-top:1px solid #f3f4f6; border-radius:0 0 12px 12px; padding:10px 16px;">
                <a href="{{ route('admin.berita.index') }}" style="font-size:.8rem; color:#C0304A; text-decoration:none; font-weight:600;">
                    Lihat Semua Berita <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Agenda Mendatang --}}
    <div class="col-lg-4">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E); color:white; border-radius:12px 12px 0 0; border:none;">
                <span style="font-weight:700; font-size:.95rem;"><i class="bi bi-calendar-event me-2"></i>Agenda Mendatang</span>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2); color:white; border:1px solid rgba(255,255,255,.3); border-radius:8px; font-size:.78rem;">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @forelse($agendaMendatang as $agenda)
                <div class="d-flex gap-3 p-3" style="border-bottom:1px solid #f3f4f6; {{ $loop->last ? 'border-bottom:none;' : '' }}">
                    {{-- Tanggal block --}}
                    <div style="flex-shrink:0; width:46px; height:52px; background:linear-gradient(135deg,#C0304A,#8B1A2E); border-radius:10px; display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; text-align:center;">
                        <div style="font-size:1.1rem; font-weight:800; line-height:1;">{{ $agenda->tanggal_mulai->format('d') }}</div>
                        <div style="font-size:.6rem; font-weight:600; text-transform:uppercase; letter-spacing:.5px; opacity:.85;">{{ $agenda->tanggal_mulai->format('M') }}</div>
                    </div>
                    {{-- Info --}}
                    <div class="flex-grow-1 min-w-0">
                        <div style="font-size:.85rem; font-weight:700; color:#1f2937; line-height:1.3; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $agenda->judul }}</div>
                        @if($agenda->lokasi)
                        <div style="font-size:.75rem; color:#9ca3af; margin-top:3px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                            <i class="bi bi-geo-alt-fill me-1" style="color:#C0304A;"></i>{{ $agenda->lokasi }}
                        </div>
                        @endif
                        @if($agenda->waktu)
                        <div style="font-size:.72rem; color:#d1d5db; margin-top:2px;">
                            <i class="bi bi-clock me-1"></i>{{ $agenda->waktu }}
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size:2.5rem; color:#e5e7eb;"></i>
                    <p style="color:#9ca3af; margin-top:8px; font-size:.875rem;">Tidak ada agenda mendatang</p>
                </div>
                @endforelse
            </div>
            <div class="card-footer" style="background:#f9fafb; border-top:1px solid #f3f4f6; border-radius:0 0 12px 12px; padding:10px 16px;">
                <a href="{{ route('admin.agenda.index') }}" style="font-size:.8rem; color:#C0304A; text-decoration:none; font-weight:600;">
                    Lihat Semua Agenda <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ===================== ROW 3: LOG AKTIVITAS ===================== --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E); color:white; border-radius:12px 12px 0 0; border:none;">
                <span style="font-weight:700; font-size:.95rem;"><i class="bi bi-activity me-2"></i>Log Aktivitas Terbaru</span>
                <span style="font-size:.78rem; opacity:.75;">{{ now()->format('d M Y, H:i') }}</span>
            </div>
            <div class="card-body p-0">
                @forelse($logTerbaru as $log)
                <div class="d-flex align-items-start gap-3 px-4 py-3" style="border-bottom:1px solid #f3f4f6; {{ $loop->last ? 'border-bottom:none;' : '' }}">

                    {{-- Avatar / Aksi Icon --}}
                    <div style="flex-shrink:0; width:38px; height:38px; border-radius:50%;
                        background:{{ match(strtolower($log->aksi ?? '')) {
                            'create','tambah','upload' => 'rgba(5,150,105,.12)',
                            'update','edit','ubah'    => 'rgba(37,99,235,.12)',
                            'delete','hapus'          => 'rgba(192,48,74,.12)',
                            'login','logout'          => 'rgba(124,58,237,.12)',
                            default                   => 'rgba(107,114,128,.1)'
                        } }};
                        display:flex; align-items:center; justify-content:center;">
                        @php
                            $aksiLower = strtolower($log->aksi ?? '');
                            $icon = match(true) {
                                in_array($aksiLower, ['create','tambah','upload']) => 'bi-plus-circle-fill',
                                in_array($aksiLower, ['update','edit','ubah'])    => 'bi-pencil-fill',
                                in_array($aksiLower, ['delete','hapus'])          => 'bi-trash-fill',
                                in_array($aksiLower, ['login'])                   => 'bi-box-arrow-in-right',
                                in_array($aksiLower, ['logout'])                  => 'bi-box-arrow-right',
                                default                                            => 'bi-activity',
                            };
                            $iconColor = match(true) {
                                in_array($aksiLower, ['create','tambah','upload']) => '#059669',
                                in_array($aksiLower, ['update','edit','ubah'])    => '#2563eb',
                                in_array($aksiLower, ['delete','hapus'])          => '#C0304A',
                                in_array($aksiLower, ['login','logout'])           => '#7c3aed',
                                default                                            => '#6b7280',
                            };
                        @endphp
                        <i class="bi {{ $icon }}" style="font-size:.95rem; color:{{ $iconColor }};"></i>
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span style="font-size:.85rem; font-weight:700; color:#1f2937;">
                                {{ $log->user?->name ?? 'Sistem' }}
                            </span>
                            @if($log->aksi)
                            <span style="font-size:.72rem; padding:2px 8px; border-radius:20px; font-weight:600;
                                background:{{ match(strtolower($log->aksi)) {
                                    'create','tambah','upload' => '#dcfce7',
                                    'update','edit','ubah'    => '#dbeafe',
                                    'delete','hapus'          => '#fee2e2',
                                    'login'                   => '#ede9fe',
                                    'logout'                  => '#f3f4f6',
                                    default                   => '#f3f4f6'
                                } }};
                                color:{{ match(strtolower($log->aksi)) {
                                    'create','tambah','upload' => '#166534',
                                    'update','edit','ubah'    => '#1e40af',
                                    'delete','hapus'          => '#991b1b',
                                    'login'                   => '#5b21b6',
                                    'logout'                  => '#374151',
                                    default                   => '#6b7280'
                                } }};">
                                {{ ucfirst($log->aksi) }}
                            </span>
                            @endif
                            @if($log->modul)
                            <span style="font-size:.72rem; padding:2px 8px; border-radius:20px; background:#f3f4f6; color:#374151; font-weight:600; border:1px solid #e5e7eb;">
                                <i class="bi bi-layers me-1"></i>{{ $log->modul }}
                            </span>
                            @endif
                        </div>
                        @if($log->deskripsi)
                        <div style="font-size:.8rem; color:#6b7280; margin-top:2px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $log->deskripsi }}</div>
                        @endif
                    </div>

                    {{-- Timestamp --}}
                    <div style="flex-shrink:0; text-align:right;">
                        <div style="font-size:.72rem; color:#9ca3af; white-space:nowrap;">{{ $log->created_at?->diffForHumans() }}</div>
                        <div style="font-size:.68rem; color:#d1d5db; white-space:nowrap;">{{ $log->created_at?->format('d/m H:i') }}</div>
                    </div>

                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-journal-x" style="font-size:2.5rem; color:#e5e7eb;"></i>
                    <p style="color:#9ca3af; margin-top:8px; font-size:.875rem;">Belum ada aktivitas tercatat</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ===================== ROW 4: QUICK LINKS ===================== --}}
<div class="row g-4">
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header" style="font-weight:700; font-size:.9rem; color:#374151;">
                <i class="bi bi-lightning-fill me-2 text-danger"></i>Aksi Cepat
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#C0304A,#8B1A2E); color:white; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-plus me-1"></i>Berita Baru
                    </a>
                    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-sm" style="background:#e0f2fe; color:#0369a1; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-plus me-1"></i>Pengumuman
                    </a>
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-sm" style="background:#fff7ed; color:#c2410c; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-calendar-event me-1"></i>Agenda
                    </a>
                    <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm" style="background:#f0fdf4; color:#15803d; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-plus me-1"></i>Upload Foto
                    </a>
                    <a href="{{ route('admin.dosen.create') }}" class="btn btn-sm" style="background:#f5f3ff; color:#6d28d9; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-plus me-1"></i>Tambah Dosen
                    </a>
                    <a href="{{ route('admin.download.index') }}" class="btn btn-sm" style="background:#fffbeb; color:#b45309; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-download me-1"></i>File Download
                    </a>
                    <a href="{{ route('admin.publikasi.index') }}" class="btn btn-sm" style="background:#f0fdfa; color:#0f766e; border:none; border-radius:10px; font-weight:600; font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-journal-richtext me-1"></i>Publikasi
                    </a>
                    <span style="width:1px; background:#e5e7eb; margin:0 4px;"></span>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-secondary rounded-2" style="font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-gear me-1"></i>Pengaturan
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-2" style="font-size:.82rem; padding:7px 16px;">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
