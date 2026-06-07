<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Manajemen Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .login-header {
            background-color: #2C3E50;
            color: white;
            padding: 24px;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }
        .login-header h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }
        .login-header p {
            font-size: 12px;
            color: #aaaaaa;
            margin: 4px 0 0;
        }
    </style>
</head>
<body>
    <div class="login-card bg-white">
        <div class="login-header">
            <h1>📝 Sistem Manajemen Blog</h1>
            <p>Masukkan kredensial Anda untuk masuk</p>
        </div>
        <div class="p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label fw-semibold" style="font-size: 13px;">
                        Username
                    </label>
                    <input type="text"
                        class="form-control @error('user_name') is-invalid @enderror"
                        id="user_name"
                        name="user_name"
                        value="{{ old('user_name') }}"
                        placeholder="Masukkan username"
                        autofocus>
                    @error('user_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold" style="font-size: 13px;">
                        Password
                    </label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success w-100 mb-3">
                    Masuk
                </button>
                <div class="text-center mt-2">
                    <a href="{{ route('public.index') }}" class="text-decoration-none text-secondary" style="font-size: 13px;">
                        &larr; Kembali ke Beranda Publik
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
