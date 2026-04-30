<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('allChildren')->whereNull('parent_id')->orderBy('urutan')->get();
        return view('admin.menu.index', compact('items'));
    }

    public function create()
    {
        $parents  = MenuItem::whereNull('parent_id')->orderBy('urutan')->get();
        $halaman  = Halaman::published()->orderBy('judul')->get();
        return view('admin.menu.create', compact('parents', 'halaman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:100',
            'tipe'      => 'required|in:route,page,url',
            'nilai'     => 'nullable|string|max:200',
            'icon'      => 'nullable|string|max:60',
            'parent_id' => 'nullable|exists:menu_items,id',
            'urutan'    => 'required|integer|min:0',
            'target'    => 'required|in:_self,_blank',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        MenuItem::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Item menu berhasil ditambahkan.');
    }

    public function edit(MenuItem $menu)
    {
        $parents  = MenuItem::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('urutan')->get();
        $halaman  = Halaman::published()->orderBy('judul')->get();
        return view('admin.menu.edit', compact('menu', 'parents', 'halaman'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:100',
            'tipe'      => 'required|in:route,page,url',
            'nilai'     => 'nullable|string|max:200',
            'icon'      => 'nullable|string|max:60',
            'parent_id' => 'nullable|exists:menu_items,id',
            'urutan'    => 'required|integer|min:0',
            'target'    => 'required|in:_self,_blank',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        // Prevent item from being its own parent
        if (isset($data['parent_id']) && $data['parent_id'] == $menu->id) {
            $data['parent_id'] = null;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Item menu berhasil diperbarui.');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return back()->with('success', 'Item menu berhasil dihapus.');
    }

    public function moveUp(MenuItem $menu)
    {
        $prev = MenuItem::where('parent_id', $menu->parent_id)
            ->where('urutan', '<', $menu->urutan)
            ->orderByDesc('urutan')->first();

        if ($prev) {
            [$menu->urutan, $prev->urutan] = [$prev->urutan, $menu->urutan];
            $menu->save();
            $prev->save();
        }

        return back()->with('success', 'Urutan diperbarui.');
    }

    public function moveDown(MenuItem $menu)
    {
        $next = MenuItem::where('parent_id', $menu->parent_id)
            ->where('urutan', '>', $menu->urutan)
            ->orderBy('urutan')->first();

        if ($next) {
            [$menu->urutan, $next->urutan] = [$next->urutan, $menu->urutan];
            $menu->save();
            $next->save();
        }

        return back()->with('success', 'Urutan diperbarui.');
    }
}
