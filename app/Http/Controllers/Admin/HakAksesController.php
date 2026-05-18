<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HakAksesController extends Controller
{
    // ─── ROLES ───────────────────────────────────────

    public function index()
    {
        $roles = Role::withCount('users')->orderBy('id')->get();
        $users = User::with('role')->orderBy('name')->get();
        return view('admin.hak-akses.index', compact('roles', 'users'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:80|unique:roles,nama',
            'permissions' => 'nullable|array',
        ]);

        Role::create([
            'nama'        => $request->nama,
            'slug'        => Str::slug($request->nama),
            'permissions' => $request->input('permissions', []),
            'is_active'   => true,
        ]);

        return back()->with('success', 'Role berhasil ditambahkan.');
    }

    public function updateRole(Request $request, Role $role)
    {
        if ($role->slug === 'super-admin') {
            return back()->withErrors(['role' => 'Role Super Admin tidak dapat diubah.']);
        }

        $request->validate([
            'nama'        => 'required|string|max:80|unique:roles,nama,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $role->update([
            'nama'        => $request->nama,
            'slug'        => Str::slug($request->nama),
            'permissions' => $request->input('permissions', []),
        ]);

        return back()->with('success', 'Role berhasil diperbarui.');
    }

    public function destroyRole(Role $role)
    {
        if ($role->slug === 'super-admin') {
            return back()->withErrors(['role' => 'Role Super Admin tidak dapat dihapus.']);
        }
        if ($role->users()->exists()) {
            return back()->withErrors(['role' => 'Role masih digunakan oleh ' . $role->users()->count() . ' pengguna.']);
        }
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus.');
    }

    // ─── USERS ───────────────────────────────────────

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'password'=> 'nullable|min:8|confirmed',
        ]);

        $data = ['name' => $request->name, 'email' => $request->email, 'role_id' => $request->role_id];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return back()->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'Tidak dapat menghapus akun sendiri.']);
        }
        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
