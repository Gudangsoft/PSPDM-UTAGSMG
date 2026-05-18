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
$moduleColors = [
    'sdm' => '#4f46e5', 'konten' => '#0891b2', 'galeri' => '#7c3aed',
    'pmb' => '#d97706', 'komunikasi' => '#16a34a', 'sistem' => '#dc2626', 'hak_akses' => '#9d174d',
];
@endphp

<div class="row g-4">

    {{-- ── ROLES ──────────────────────────────── --}}
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-shield-lock me-2"></i>Manajemen Role</span>
                <button class="btn btn-sm btn-admin-primary" onclick="document.getElementById('addRolePanel').classList.toggle('d-none')">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Role
                </button>
            </div>

            {{-- Add role form --}}
            <div id="addRolePanel" class="d-none border-top p-4" style="background:#fafafa;">
                <form action="{{ route('admin.hak-akses.store-role') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="cth: Editor Berita">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hak Akses Modul</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($modules as $key => $label)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $key }}" id="np_{{ $key }}">
                                    <label class="form-check-label" for="np_{{ $key }}" style="font-size:.82rem;">{{ $label }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-admin-primary w-100">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Role</th>
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
                                    <br><small class="text-muted font-monospace">{{ $role->slug }}</small>
                                </td>
                                <td>
                                    @if(in_array('all', $role->permissions ?? []))
                                    <span class="badge" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;">Akses Penuh</span>
                                    @else
                                    @foreach($role->permissions ?? [] as $perm)
                                    <span class="badge me-1" style="background:{{ $moduleColors[$perm] ?? '#666' }}22;color:{{ $moduleColors[$perm] ?? '#666' }};border:1px solid {{ $moduleColors[$perm] ?? '#666' }}44;font-size:.72rem;">
                                        {{ $modules[$perm] ?? $perm }}
                                    </span>
                                    @endforeach
                                    @if(empty($role->permissions))
                                    <span class="text-muted" style="font-size:.82rem;">Tidak ada akses</span>
                                    @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $role->users_count }}</span>
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
                                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;color:white;flex-shrink:0;">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $u->name }}</span>
                                    @if($u->id === auth()->id())
                                    <span class="badge bg-light text-muted" style="font-size:.68rem;">Anda</span>
                                    @endif
                                </div>
                            </td>
                            <td style="font-size:.85rem; color:#555;">{{ $u->email }}</td>
                            <td>
                                @if($u->role)
                                <span class="badge rounded-pill" style="background:#f0f4ff;color:#333;font-size:.78rem;">{{ $u->role->nama }}</span>
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
                                          onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
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
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0"><h6 class="modal-title fw-bold">Edit Role</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="editRoleForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" name="nama" id="er_nama" class="form-control" required>
                    </div>
                    <label class="form-label">Hak Akses Modul</label>
                    <div class="d-flex flex-column gap-2">
                        @foreach($modules as $key => $label)
                        <div class="form-check">
                            <input class="form-check-input er-perm" type="checkbox" name="permissions[]" value="{{ $key }}" id="er_{{ $key }}">
                            <label class="form-check-label" for="er_{{ $key }}">
                                <span class="fw-semibold">{{ $label }}</span>
                            </label>
                        </div>
                        @endforeach
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

<script>
function openEditRole(id, nama, perms) {
    document.getElementById('editRoleForm').action = '/admin/hak-akses/role/' + id;
    document.getElementById('er_nama').value = nama;
    document.querySelectorAll('.er-perm').forEach(cb => cb.checked = perms.includes(cb.value));
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
