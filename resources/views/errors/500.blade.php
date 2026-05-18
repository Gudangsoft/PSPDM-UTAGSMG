<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 – Kesalahan Server</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Segoe UI', sans-serif; }
        .error-code { font-size: 8rem; font-weight: 900; background: linear-gradient(135deg, #C0304A, #8B1A2E); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .divider { width: 60px; height: 4px; background: linear-gradient(135deg, #C0304A, #8B1A2E); border-radius: 2px; margin: 16px auto; }
    </style>
</head>
<body>
    <div class="text-center px-4">
        <div class="error-code">500</div>
        <div class="divider"></div>
        <h2 class="fw-bold mb-2" style="color:#222;">Terjadi Kesalahan Server</h2>
        <p class="text-muted mb-4" style="max-width:400px; margin:0 auto 24px;">Kami sedang mengalami gangguan teknis. Silakan coba beberapa saat lagi atau hubungi administrator.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ url('/') }}" class="btn btn-danger px-4 rounded-pill"><i class="bi bi-house me-2"></i>Kembali ke Beranda</a>
            <button onclick="location.reload()" class="btn btn-outline-secondary px-4 rounded-pill"><i class="bi bi-arrow-clockwise me-2"></i>Coba Lagi</button>
        </div>
        <p class="mt-5 text-muted" style="font-size:.78rem;">PSMPD FEB UNTAG Semarang &mdash; pspdm.untagsmg.ac.id</p>
    </div>
</body>
</html>
