<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body { margin:0; padding:0; background:#f4f4f4; font-family:Arial,sans-serif; color:#333; }
  .wrap { max-width:600px; margin:24px auto; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.1); }
  .header { background:#C0304A; padding:28px 32px; text-align:center; }
  .header h1 { margin:0; color:#fff; font-size:22px; font-weight:700; }
  .header p  { margin:6px 0 0; color:rgba(255,255,255,.8); font-size:13px; }
  .body { padding:28px 32px; }
  .field { margin-bottom:18px; }
  .label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; color:#999; margin-bottom:4px; }
  .value { font-size:15px; color:#222; }
  .value a { color:#C0304A; text-decoration:none; }
  .pesan-box { background:#fafafa; border-left:4px solid #C0304A; border-radius:4px; padding:16px 20px; font-size:14px; line-height:1.75; white-space:pre-wrap; color:#444; }
  .divider { border:none; border-top:1px solid #eee; margin:24px 0; }
  .footer { background:#f9f9f9; padding:20px 32px; text-align:center; font-size:12px; color:#888; }
  .footer a { color:#C0304A; text-decoration:none; }
  .badge { display:inline-block; background:#fff5f5; color:#C0304A; border:1px solid #f5c6cc; border-radius:20px; padding:3px 12px; font-size:12px; font-weight:600; margin-bottom:16px; }
</style>
</head>
<body>
<div class="wrap">

  <div class="header">
    <h1>📩 Pesan Baru Masuk</h1>
    <p>PSMPD-FEB Universitas 17 Agustus 1945 Semarang</p>
  </div>

  <div class="body">
    <span class="badge">Formulir Kontak Website</span>

    <div class="field">
      <div class="label">Nama Lengkap</div>
      <div class="value">{{ $data['nama'] }}</div>
    </div>

    <div class="field">
      <div class="label">Email</div>
      <div class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
    </div>

    @if(!empty($data['telepon']))
    <div class="field">
      <div class="label">Nomor Telepon</div>
      <div class="value">{{ $data['telepon'] }}</div>
    </div>
    @endif

    <div class="field">
      <div class="label">Subjek</div>
      <div class="value" style="font-weight:600;">{{ $data['subjek'] }}</div>
    </div>

    <hr class="divider">

    <div class="field">
      <div class="label">Isi Pesan</div>
      <div class="pesan-box">{{ $data['pesan'] }}</div>
    </div>

    <hr class="divider">

    <p style="font-size:13px; color:#666; margin:0;">
      Untuk membalas, klik tombol Reply pada email ini — pengirim sudah diatur ke
      <strong>{{ $data['email'] }}</strong>.
    </p>
  </div>

  <div class="footer">
    <p>Email ini dikirim otomatis oleh sistem website PSMPD-FEB UNTAG Semarang.<br>
       Diterima: {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
    <p><a href="{{ url('/admin') }}">Buka Panel Admin</a> &nbsp;|&nbsp;
       <a href="{{ url('/admin/pesan') }}">Lihat Semua Pesan</a></p>
  </div>

</div>
</body>
</html>
