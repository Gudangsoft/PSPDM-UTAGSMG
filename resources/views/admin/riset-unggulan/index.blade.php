@extends('layouts.admin')
@section('title', 'Unggulan Riset')
@section('page-title', 'Unggulan Riset')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1" style="font-weight:700;">Unggulan Riset</h5>
        <small class="text-muted">Ditampilkan di <a href="{{ route('penelitian') }}" target="_blank">/penelitian</a></small>
    </div>
    <a href="{{ route('admin.riset-unggulan.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Konsentrasi
    </a>
</div>

@forelse($items as $item)
<div class="admin-card card mb-3" style="border-left:4px solid {{ $item->warna }};">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1 me-3">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div style="width:14px;height:14px;border-radius:3px;background:{{ $item->warna }};flex-shrink:0;"></div>
                    <h6 class="mb-0 fw-bold" style="color:#1e293b;">{{ $item->judul }}</h6>
                    @if(!$item->is_active)<span class="badge bg-secondary ms-1" style="font-size:.65rem;">Nonaktif</span>@endif
                </div>
                @if($item->deskripsi)
                <small class="text-muted ms-4">{{ $item->deskripsi }}</small>
                @endif

                <div class="row g-2 mt-2 ms-2">
                    @foreach([['a',$item->topik_a],['b',$item->topik_b],['c',$item->topik_c]] as [$lbl,$topik])
                    @if($topik)
                    <div class="col-md-4">
                        <div class="p-2 rounded-2" style="background:#f8fafc;border:1px solid #e2e8f0;">
                            <span class="badge mb-1" style="background:{{ $item->warna }};font-size:.65rem;">Riset {{ $lbl }}</span>
                            <div style="font-size:.8rem;color:#374151;line-height:1.4;">{{ $topik }}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-column gap-1" style="flex-shrink:0;">
                <a href="{{ route('admin.riset-unggulan.edit', $item) }}" class="btn btn-sm btn-outline-primary rounded-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.riset-unggulan.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Hapus konsentrasi riset ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-2 w-100"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<div class="admin-card card">
    <div class="card-body text-center text-muted py-5">Belum ada data unggulan riset</div>
</div>
@endforelse

@endsection
