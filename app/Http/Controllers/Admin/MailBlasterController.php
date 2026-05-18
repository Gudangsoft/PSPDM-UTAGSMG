<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailBlasterController extends Controller
{
    public function index()
    {
        return view('admin.mail.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subjek'  => 'required|string|max:200',
            'pesan'   => 'required|string',
            'penerima'=> 'required|string',
        ]);

        $emails = array_filter(array_map('trim', explode("\n", $request->penerima)));
        $emails = array_filter($emails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL));

        if (empty($emails)) {
            return back()->withErrors(['penerima' => 'Tidak ada alamat email valid yang ditemukan.']);
        }

        $nama  = Setting::where('key', 'nama')->value('value') ?? 'PSPDM FEB UNTAG';
        $from  = Setting::where('key', 'email')->value('value') ?? config('mail.from.address');
        $berhasil = 0; $gagal = 0;

        foreach ($emails as $email) {
            try {
                Mail::html($request->pesan, function ($m) use ($email, $request, $nama, $from) {
                    $m->to($email)
                      ->subject($request->subjek)
                      ->from($from, $nama);
                });
                $berhasil++;
            } catch (\Throwable $e) {
                $gagal++;
            }
        }

        return back()->with('mail_result', ['berhasil' => $berhasil, 'gagal' => $gagal, 'total' => count($emails)]);
    }
}
