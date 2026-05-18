<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('urutan')->orderBy('id')->paginate(25);
        return view('admin.faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
            'kategori'   => 'nullable|string|max:80',
            'urutan'     => 'nullable|integer',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'kategori'   => $request->kategori,
            'urutan'     => $request->urutan ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        ActivityLog::catat('tambah', 'faq', 'Tambah FAQ');
        return back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
            'kategori'   => 'nullable|string|max:80',
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'kategori'   => $request->kategori,
            'urutan'     => $request->urutan ?? 0,
            'is_active'  => $request->boolean('is_active'),
        ]);

        ActivityLog::catat('edit', 'faq', 'Edit FAQ #' . $faq->id);
        return back()->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        ActivityLog::catat('hapus', 'faq', 'Hapus FAQ #' . $faq->id);
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus.');
    }
}
