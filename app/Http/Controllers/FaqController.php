<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::aktif()->terurut()->get()->groupBy('kategori');
        return view('faq', compact('faqs'));
    }
}
