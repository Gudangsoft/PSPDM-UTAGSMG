<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PSMPD-FEB UNTAG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #952035 0%, #C0304A 50%, #952035 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white; border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            overflow: hidden; width: 100%; max-width: 440px;
        }
        .login-header {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            padding: 36px 40px; text-align: center; color: white;
        }
        .login-logo {
            width: 72px; height: 72px; background: linear-gradient(135deg, #C0304A, #952035);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; font-weight: 900; color: white;
            margin: 0 auto 16px; box-shadow: 0 8px 20px rgba(192,48,74,0.4);
        }
        .login-header h4 { font-size: 1rem; font-weight: 700; margin: 0 0 4px; }
        .login-header p { font-size: 0.78rem; opacity: 0.75; margin: 0; }
        .login-body { padding: 36px 40px; }
        .form-control { border-color: #e8e8e8; border-radius: 10px; padding: 12px 16px; font-size: .875rem; }
        .form-control:focus { border-color: #C0304A; box-shadow: 0 0 0 .2rem rgba(192,48,74,.1); }
        .input-group-text { border-color: #e8e8e8; border-radius: 10px 0 0 10px; background: #f8f9fa; color: #888; }
        .btn-login {
            background: linear-gradient(135deg, #C0304A, #952035); border: none;
            color: white; font-weight: 700; border-radius: 10px;
            padding: 13px; font-size: .95rem; letter-spacing: .3px;
            transition: opacity .2s, transform .1s;
        }
        .btn-login:hover { opacity: .92; color: white; transform: translateY(-1px); }
        .back-link { color: #C0304A; text-decoration: none; font-size: .82rem; font-weight: 500; }
        .back-link:hover { text-decoration: underline; }
        .divider { border-color: #f0f0f0; margin: 20px 0; }
        .alert-danger { background: #fff5f5; border-color: #ffcccc; color: #c53030; border-radius: 10px; font-size: .875rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">S3</div>
            <h4>Panel Administrator</h4>
            <p>PSMPD-FEB UNTAG Semarang</p>
        </div>
        <div class="login-body">
            <h5 style="font-weight:700; color:#1a1a2e; margin-bottom:6px;">Selamat Datang</h5>
            <p class="text-muted mb-4" style="font-size:.875rem;">Masuk dengan akun administrator Anda</p>

            @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" style="font-weight:600; font-size:.85rem;">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" value="{{ old('email') }}" placeholder="admin@psmpd.ac.id" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label" style="font-weight:600; font-size:.85rem;">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:.83rem; color:#666;">Ingat saya</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <hr class="divider">
            <div class="text-center">
                <a href="{{ route('home') }}" class="back-link">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
