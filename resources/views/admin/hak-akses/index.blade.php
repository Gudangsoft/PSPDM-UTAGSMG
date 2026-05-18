@extends('layouts.admin')
@section('title', 'Hak Akses')
@section('page-title', 'Hak Akses & Pengguna')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-x-circle me-2"></i>{{ $errors->first() }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@php
$modules = \App\Models\Role::$modules;
$moduleMeta = [
    'sdm'        => ['icon' => 'bi-people-fill',      'color' => '#4f46e5', 'desc' => 'Dosen, Jabatan, Pejabat, Konsentrasi'],
    'konten'     => ['icon' => 'bi-file-earmark-text','color' => '#0891b2', 'desc' => 'Berita, Pengumuman, Halaman, Menu'],
    'galeri'     => ['icon' => 'bi-images',            'color' => '#7c3aed', 'desc' => 'Galeri foto & Album'],
    'pmb'        => ['icon' => 'bi-calendar-event',   'color' => '#d97706', 'desc' => 'Jadwal Penerimaan Mahasiswa Baru'],
    'komunikasi' => ['icon' => 'bi-chat-dots-fill',   'color' => '#16a34a', 'desc' => 'Pesan Masuk, WA Blaster, Email'],
    'sistem'     => ['icon' => 'bi-gear-fill',         'color' => '#dc2626', 'desc' => 'Pengaturan website & Beranda'],
    'hak_akses'  => ['icon' => 'bi-shield-lock-fill', 'color' => '#9d174d', 'desc' => 'Kelola Role & Pengguna admin'],
];
@endphp

<div class="row g-4">

    {{-- ── ROLES ──────────────────────────────── --}}
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-shield-lock me-2"></i>Manajemen Role</span>
                <button class="btn btn-sm btn-admin-primary" onclick="toggleAddRole()">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Role
                </button>
            </div>

            {{-- Add role form --}}
            <div id="addRolePanel" class="d-none border-top p-4" style="background:#fafafa;">
                <form action="{{ route('admin.hak-akses.store-role') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="cth: Editor Berita" style="max-width:320px;" required>
                    </div>
                    <label class="form-label fw-semibold mb-2">Pilih Hak Akses Modul</label>
                    <div class="perm-grid mb-3" id="addPermGrid">
                        @foreach($modules as $key => $label)
                        @php $m = $moduleMeta[$key] ?? ['icon'=>'bi-circle','color'=>'#666','desc'=>'']; @endphp
                        <label class="perm-card" for="np_{{ $key }}">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}" id="np_{{ $key }}" class="perm-cb">
                            <div class="perm-icon" style="background:{{ $m['color'] }}18;color:{{ $m['color'] }};">
                                <i class="bi {{ $m['icon'] }}"></i>
                            </div>
                            <div class="perm-info">
                                <div class="perm-name">{{ $label }}</div>
                                <div class="perm-desc">{{ $m['desc'] }}</div>
                            </div>
                            <div class="perm-check"><i class="bi bi-check2"></i></div>
                        </label>
                        @endforeach
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary btn-sm px-4">
                            <i class="bi bi-save me-1"></i>Simpan Role
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleAddRole()">Batal</button>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th style="width:220px;">Role</th>
                                <th>Hak Akses Modul</th>
                                <th class="text-center" style="width:80px;">Pengguna</th>
                                <th class="text-center" style="width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $role->nama }}</span>
                                    <br><small class="text-muted font-monospace" style="font-size:.72rem;">{{ $role->slug }}</small>
                                </td>
                                <td>
                                    @if(in_array('all', $role->permissions ?? []))
                                    <span class="badge" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;font-size:.75rem;">
                                        <i class="bi bi-infinity me-1"></i>Akses Penuh
                                    </span>
                                    @else
                                        @forelse($role->permissions ?? [] as $perm)
                                        @php $m = $moduleMeta[$perm] ?? ['icon'=>'bi-circle','color'=>'#666']; @endphp
                                        <span class="badge me-1 mb-1" style="background:{{ $m['color'] }}18;color:{{ $m['color'] }};border:1px solid {{ $m['color'] }}33;font-size:.72rem;">
                                            <i class="bi {{ $m['icon'] }} me-1"></i>{{ $modules[$perm] ?? $perm }}
                                        </span>
                                        @empty
                                        <span class="text-muted" style="font-size:.82rem;">Tidak ada akses</span>
                                        @endforelse
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $role->users_count }}</span>
                                </td>
                                <td class="text-center">
                                    @if($role->slug !== 'super-admin')
                                    <button class="btn btn-sm btn-outline-primary rounded-2 me-1"
                                            onclick="openEditRole({{ $role->id }}, '{{ addslashes($role->nama) }}', {{ json_encode($role->permissions ?? []) }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.hak-akses.destroy-role', $role) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus role {{ $role->nama }}?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @else
                                    <span class="text-muted" style="font-size:.75rem;">Dilindungi</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ── USERS ──────────────────────────────── --}}
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-people me-2"></i>Manajemen Pengguna</span>
                <button class="btn btn-sm btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus me-1"></i>Tambah Pengguna
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th class="text-center" style="width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($u->foto)
                                    <img src="{{ $u->foto_url }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                                    @else
                                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;color:white;flex-shrink:0;">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    @endif
                                    <span class="fw-semibold">{{ $u->name }}</span>
                                    @if($u->id === auth()->id())
                                    <span class="badge bg-light text-muted border" style="font-size:.68rem;">Anda</span>
                                    @endif
                                </div>
                            </td>
                            <td style="font-size:.85rem; color:#555;">{{ $u->email }}</td>
                            <td>
                                @if($u->role)
                                @php $firstPerm = $u->role->permissions[0] ?? null; $m2 = $firstPerm ? ($moduleMeta[$firstPerm] ?? null) : null; @endphp
                                <span class="badge rounded-pill" style="background:{{ in_array('all',$u->role->permissions??[]) ? '#fff0f3' : ($m2 ? $m2['color'].'18' : '#f0f4ff') }};color:{{ in_array('all',$u->role->permissions??[]) ? '#C0304A' : ($m2 ? $m2['color'] : '#333') }};border:1px solid {{ in_array('all',$u->role->permissions??[]) ? '#f5c0cc' : ($m2 ? $m2['color'].'33' : '#dde') }};font-size:.78rem;">
                                    {{ $u->role->nama }}
                                </span>
                                @else
                                <span class="text-muted" style="font-size:.82rem;">—</span>
                                @endif
                            </td>
                            <td style="font-size:.82rem;color:#888;">{{ $u->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-2"
                                            onclick="openEditUser({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ $u->email }}', {{ $u->role_id ?? 'null' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.hak-akses.destroy-user', $u) }}" method="POST"
                                          onsubmit="return confirm('Hapus pengguna {{ addslashes($u->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pengguna.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Role --}}
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="bi bi-shield-lock me-2"></i>Edit Role</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editRoleForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="er_nama" class="form-control" required>
                    </div>
                    <label class="form-label fw-semibold mb-2">Pilih Hak Akses Modul</label>
                    <p class="text-muted mb-3" style="font-size:.82rem;">Centang modul yang boleh diakses oleh role ini.</p>
                    <div class="perm-grid" id="editPermGrid">
                        @foreach($modules as $key => $label)
                        @php $m = $moduleMeta[$key] ?? ['icon'=>'bi-circle','color'=>'#666','desc'=>'']; @endphp
                        <label class="perm-card" for="er_{{ $key }}">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}" id="er_{{ $key }}" class="perm-cb er-perm">
                            <div class="perm-icon" style="background:{{ $m['color'] }}18;color:{{ $m['color'] }};">
                                <i class="bi {{ $m['icon'] }}"></i>
                            </div>
                            <div class="perm-info">
                                <div class="perm-name">{{ $label }}</div>
                                <div class="perm-desc">{{ $m['desc'] }}</div>
                            </div>
                            <div class="perm-check"><i class="bi bi-check2"></i></div>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-4">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah User --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0"><h6 class="modal-title fw-bold">Tambah Pengguna</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('admin.hak-akses.store-user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $r)
                            <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit User --}}
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0"><h6 class="modal-title fw-bold">Edit Pengguna</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="editUserForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="eu_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="eu_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" id="eu_role" class="form-select" required>
                            @foreach($roles as $r)
                            <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control" minlength="8">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Permission card grid */
.perm-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 10px;
}
.perm-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    transition: all .15s;
    background: #fff;
    position: relative;
    user-select: none;
}
.perm-card:hover { border-color: #C0304A44; background: #fff5f7; }
.perm-cb { position: absolute; opacity: 0; width: 0; height: 0; }
.perm-cb:checked ~ .perm-icon { opacity: 1; }
.perm-cb:checked + .perm-icon { opacity: 1; }
.perm-card:has(.perm-cb:checked) {
    border-color: #C0304A;
    background: #fff5f7;
}
.perm-card:has(.perm-cb:checked) .perm-check {
    opacity: 1;
    background: #C0304A;
    color: white;
}
.perm-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.perm-info { flex: 1; min-width: 0; }
.perm-name { font-size: .82rem; font-weight: 600; color: #222; }
.perm-desc { font-size: .72rem; color: #888; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.perm-check {
    width: 22px; height: 22px;
    border-radius: 50%;
    border: 2px solid #ddd;
    display: flex; align-items: center; justify-content: center;
    font-size: .7rem;
    flex-shrink: 0;
    opacity: 0;
    transition: all .15s;
}
.perm-card:has(.perm-cb:checked) .perm-check { opacity: 1; border-color: #C0304A; }
</style>

<script>
function toggleAddRole() {
    const panel = document.getElementById('addRolePanel');
    panel.classList.toggle('d-none');
}

function openEditRole(id, nama, perms) {
    document.getElementById('editRoleForm').action = '/admin/hak-akses/role/' + id;
    document.getElementById('er_nama').value = nama;
    document.querySelectorAll('.er-perm').forEach(cb => {
        cb.checked = perms.includes(cb.value);
    });
    new bootstrap.Modal(document.getElementById('editRoleModal')).show();
}

function openEditUser(id, name, email, roleId) {
    document.getElementById('editUserForm').action = '/admin/hak-akses/user/' + id;
    document.getElementById('eu_name').value  = name;
    document.getElementById('eu_email').value = email;
    document.getElementById('eu_role').value  = roleId ?? '';
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}
</script>
@endsection
