<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaBlasterController extends Controller
{
    public function index()
    {
        $apiKey  = Setting::where('key', 'wa_api_key')->value('value') ?? '';
        $apiSender = Setting::where('key', 'wa_sender')->value('value') ?? '';
        return view('admin.wa.index', compact('apiKey', 'apiSender'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'pesan'  => 'required|string',
            'nomor'  => 'required|string',
        ]);

        $apiKey  = Setting::where('key', 'wa_api_key')->value('value');
        $sender  = Setting::where('key', 'wa_sender')->value('value');

        if (!$apiKey || !$sender) {
            return back()->withErrors(['api' => 'API Key atau Nomor Pengirim belum dikonfigurasi di Pengaturan.']);
        }

        $nomors = array_filter(array_map('trim', explode("\n", $request->nomor)));
        $berhasil = 0; $gagal = 0; $errors = [];

        foreach ($nomors as $no) {
            $no = preg_replace('/[^0-9]/', '', $no);
            if (str_starts_with($no, '0')) $no = '62' . substr($no, 1);

            try {
                $res = Http::timeout(10)->post('https://api.fonnte.com/send', [
                    'target'  => $no,
                    'message' => $request->pesan,
                    'token'   => $apiKey,
                ]);
                $json = $res->json();
                if ($json['status'] ?? false) { $berhasil++; } else { $gagal++; $errors[] = $no . ': ' . ($json['reason'] ?? 'Gagal'); }
            } catch (\Throwable $e) {
                $gagal++; $errors[] = $no . ': ' . $e->getMessage();
            }
        }

        $msg = "Terkirim: {$berhasil}";
        if ($gagal) $msg .= ", Gagal: {$gagal}";

        return back()->with('wa_result', ['berhasil' => $berhasil, 'gagal' => $gagal, 'errors' => $errors]);
    }
}
