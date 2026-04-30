@extends('layouts.admin')
@section('title', 'Menu Navigasi')
@section('page-title', 'Menu Navigasi')
@section('styles')
<style>
.menu-tree-item {
    border-radius: 10px; border: 1px solid #f0f0f0;
    background: white; margin-bottom: 6px; transition: box-shadow .2s;
}
.menu-tree-item:hover { box-shadow: 0 2px 12px rgba(0,0,0,.08); }
.menu-tree-item .item-bar {
    display: flex; align-items: center; gap: 12px; padding: 12px 16px;
}
.menu-children { padding: 0 0 8px 40px; }
.menu-child-item {
    border-radius: 8px; border: 1px solid #f5f5f5;
    background: #fafafa; margin-bottom: 4px;
}
.menu-child-item .item-bar { padding: 10px 16px; }
.tipe-badge { font-size:.72rem; padding:2px 8px; border-radius:12px; font-weight:600; }
.tipe-route { background:#e8f4fd; color:#1a6fa8; }
.tipe-page  { background:#e8f8f0; color:#1a7a40; }
.tipe-url   { background:#fef3e2; color:#8a5a00; }
.sort-btn { padding:2px 7px; font-size:.75rem; border-radius:6px; line-height:1.4; }
.inactive-item { opacity:.5; }
</style>
@endsection
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:.875rem;">Susun menu navigasi website. Perubahan langsung tampil di navbar.</p>
    </div>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Item Menu
    </a>
</div>

@if($items->isEmpty())
<div class="admin-card card text-center py-5 text-muted">
    <i class="bi bi-list-ul display-4 d-block mb-2 opacity-25"></i>
    <p>Belum ada item menu. <a href="{{ route('admin.menu.create') }}">Tambah sekarang</a></p>
</div>
@else
<div class="admin-card card p-3">
    <div class="d-flex align-items-center gap-2 mb-3 px-1" style="font-size:.78rem; color:#aaa;">
        <i class="bi bi-info-circle"></i>
        Item dengan anak-item (dropdown) ditampilkan bersama sub-itemnya.
        Gunakan <i class="bi bi-arrow-up"></i>/<i class="bi bi-arrow-down"></i> untuk mengubah urutan.
    </div>

    @foreach($items as $item)
    <div class="menu-tree-item {{ !$item->is_active ? 'inactive-item' : '' }}">
        <div class="item-bar">
            {{-- Sort --}}
            <div class="d-flex flex-column gap-1">
                <form action="{{ route('admin.menu.moveUp', $item) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-secondary sort-btn" title="Naik"><i class="bi bi-arrow-up"></i></button>
                </form>
                <form action="{{ route('admin.menu.moveDown', $item) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-secondary sort-btn" title="Turun"><i class="bi bi-arrow-down"></i></button>
                </form>
            </div>

            {{-- Icon --}}
            <div style="width:36px; height:36px; background:#f0f0f0; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#666; flex-shrink:0;">
                @if($item->icon)
                    <i class="bi {{ $item->icon }}"></i>
                @else
                    <i class="bi bi-link-45deg"></i>
                @endif
            </div>

            {{-- Label & info --}}
            <div class="flex-grow-1">
                <div style="font-weight:600; color:#1a1a2e; font-size:.9rem;">
                    {{ $item->label }}
                    @if($item->allChildren->count() > 0)
                        <span class="badge bg-primary-subtle text-primary ms-1" style="font-size:.68rem;">
                            dropdown ({{ $item->allChildren->count() }})
                        </span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="tipe-badge tipe-{{ $item->tipe }}">{{ strtoupper($item->tipe) }}</span>
                    <span style="font-size:.78rem; color:#aaa;">{{ $item->nilai ?: '—' }}</span>
                </div>
            </div>

            {{-- Status --}}
            @if($item->is_active)
                <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:.72rem;">Aktif</span>
            @else
                <span class="badge bg-secondary-subtle text-secondary" style="font-size:.72rem;">Nonaktif</span>
            @endif

            {{-- Actions --}}
            <div class="d-flex gap-1">
                <a href="{{ route('admin.menu.edit', $item) }}" class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.menu.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Hapus item ini beserta sub-itemnya?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Children --}}
        @if($item->allChildren->count() > 0)
        <div class="menu-children">
            @foreach($item->allChildren as $child)
            <div class="menu-child-item {{ !$child->is_active ? 'inactive-item' : '' }}">
                <div class="item-bar">
                    <div class="d-flex flex-column gap-1">
                        <form action="{{ route('admin.menu.moveUp', $child) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary sort-btn"><i class="bi bi-arrow-up"></i></button>
                        </form>
                        <form action="{{ route('admin.menu.moveDown', $child) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary sort-btn"><i class="bi bi-arrow-down"></i></button>
                        </form>
                    </div>
                    <div style="width:28px; height:28px; background:#eee; border-radius:6px; display:flex; align-items:center; justify-content:center; color:#888; flex-shrink:0; font-size:.85rem;">
                        @if($child->icon)
                            <i class="bi {{ $child->icon }}"></i>
                        @else
                            <i class="bi bi-dash"></i>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div style="font-weight:500; color:#333; font-size:.875rem;">{{ $child->label }}</div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="tipe-badge tipe-{{ $child->tipe }}">{{ strtoupper($child->tipe) }}</span>
                            <span style="font-size:.75rem; color:#aaa;">{{ $child->nilai ?: '—' }}</span>
                        </div>
                    </div>
                    @if(!$child->is_active)
                        <span class="badge bg-secondary-subtle text-secondary" style="font-size:.68rem;">Nonaktif</span>
                    @endif
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.menu.edit', $child) }}" class="btn btn-sm btn-outline-primary rounded-2">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.menu.destroy', $child) }}" method="POST"
                              onsubmit="return confirm('Hapus sub-item ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endforeach
</div>
@endif

@endsection
