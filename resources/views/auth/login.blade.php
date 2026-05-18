<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – PSPDM FEB UNTAG Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #7B1020 0%, #C0304A 50%, #7B1020 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white; border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.35);
            overflow: hidden; width: 100%; max-width: 440px;
        }
        .login-header {
            background: linear-gradient(160deg, #1a1a2e 0%, #0f2044 100%);
            padding: 32px 40px 28px; text-align: center; color: white;
        }
        .login-logo-wrap {
            width: 80px; height: 80px; border-radius: 14px;
            background: white; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            overflow: hidden;
        }
        .login-logo-wrap img { width: 70px; height: 70px; object-fit: contain; }
        .login-logo-text {
            width: 80px; height: 80px; border-radius: 14px;
            background: linear-gradient(135deg, #C0304A, #7B1020);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 6px 20px rgba(192,48,74,0.4);
        }
        .login-logo-text span:first-child { font-size: 1.5rem; font-weight: 900; color: white; line-height: 1; }
        .login-logo-text span:last-child  { font-size: .55rem; font-weight: 600; color: rgba(255,255,255,.8); letter-spacing: 1px; margin-top: 3px; }
        .login-header h4 { font-size: 1rem; font-weight: 700; margin: 0 0 4px; }
        .login-header p  { font-size: 0.75rem; opacity: 0.65; margin: 0; }
        .login-body  { padding: 32px 40px 36px; }
        .form-label  { font-weight: 600; font-size: .83rem; color: #333; }
        .form-control { border-color: #e5e5e5; border-radius: 10px; padding: 11px 14px; font-size: .875rem; }
        .form-control:focus { border-color: #C0304A; box-shadow: 0 0 0 .2rem rgba(192,48,74,.12); }
        .input-group-text { border-color: #e5e5e5; background: #f8f8f8; color: #999;
                            border-radius: 10px 0 0 10px; padding: 0 13px; }
        .form-control.border-start-0 { border-left: none; border-radius: 0 10px 10px 0; }
        .captcha-box {
            display: flex; align-items: center; gap: 10px;
            background: #f8f8f8; border: 1px solid #e5e5e5; border-radius: 10px;
            padding: 10px 14px;
        }
        .captcha-question {
            font-size: 1rem; font-weight: 700; color: #1a1a2e;
            background: white; border: 1px solid #ddd; border-radius: 8px;
            padding: 6px 14px; white-space: nowrap;
        }
        .captcha-eq { font-size: .9rem; color: #888; }
        .captcha-input {
            width: 80px; border: 1px solid #e5e5e5; border-radius: 8px;
            padding: 7px 10px; font-size: .9rem; font-weight: 700; text-align: center;
            outline: none;
        }
        .captcha-input:focus { border-color: #C0304A; box-shadow: 0 0 0 2px rgba(192,48,74,.12); }
        .btn-login {
            background: linear-gradient(135deg, #C0304A, #8B1A2E); border: none;
            color: white; font-weight: 700; border-radius: 10px;
            padding: 13px; font-size: .95rem; letter-spacing: .3px;
            transition: opacity .2s, transform .1s; width: 100%;
        }
        .btn-login:hover { opacity: .9; color: white; transform: translateY(-1px); }
        .back-link { color: #C0304A; text-decoration: none; font-size: .82rem; font-weight: 500; }
        .back-link:hover { text-decoration: underline; }
        .alert-danger { background: #fff5f5; border-color: #ffcccc; color: #c53030; border-radius: 10px; font-size: .84rem; }
        hr { border-color: #f0f0f0; }
    </style>
</head>
<body>
    <div class="login-card">

        {{-- Header / Brand --}}
        <div class="login-header">
            @php
                $logoPath = public_path('storage/' . (optional(\App\Models\Setting::where('key','logo')->first())->value ?? ''));
                $hasLogo  = file_exists($logoPath) && !empty(optional(\App\Models\Setting::where('key','logo')->first())->value);
            @endphp
            @if($hasLogo)
            <div class="login-logo-wrap">
                <img src="{{ asset('storage/' . \App\Models\Setting::where('key','logo')->value('value')) }}" alt="Logo">
            </div>
            @else
            <div class="login-logo-text">
                <span>S3</span>
                <span>FEB UNTAG</span>
            </div>
            @endif
            <h4>Panel Administrator</h4>
            <p>Program Studi Manajemen Program Doktor<br>FEB UNTAG Semarang</p>
        </div>

        {{-- Body --}}
        <div class="login-body">
            <h5 style="font-weight:700; color:#1a1a2e; margin-bottom:4px;">Selamat Datang</h5>
            <p class="text-muted mb-4" style="font-size:.83rem;">Masuk dengan akun administrator Anda</p>

            @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope" style="font-size:.85rem;"></i></span>
                        <input type="email" name="email" class="form-control border-start-0"
                               value="{{ old('email') }}" placeholder="admin@pspdm.ac.id" required autofocus>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock" style="font-size:.85rem;"></i></span>
                        <input type="password" name="password" class="form-control border-start-0"
                               placeholder="••••••••" required>
                    </div>
                </div>

                {{-- CAPTCHA --}}
                <div class="mb-4">
                    <label class="form-label">Verifikasi <span class="text-danger">*</span></label>
                    <div class="captcha-box">
                        <div class="captcha-question">{{ $a }} + {{ $b }}</div>
                        <span class="captcha-eq">=</span>
                        <input type="number" name="captcha" class="captcha-input @error('captcha') border-danger @enderror"
                               placeholder="?" min="0" max="18" autocomplete="off" required>
                        <span class="text-muted ms-auto" style="font-size:.75rem; white-space:nowrap;">Anti-bot</span>
                    </div>
                    @error('captcha')
                    <div class="text-danger mt-1" style="font-size:.8rem;"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:.82rem; color:#666;">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <hr class="my-4">
            <div class="text-center">
                <a href="{{ route('home') }}" class="back-link">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
