<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Manajemen Cuci Mobil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            width: 100%;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #66a6ff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #66a6ff;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s;
        }

        .btn:hover {
            background-color: #4d8bff;
            transform: translateY(-2px);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
            color: #555;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .login-link:hover {
            color: #333;
            text-decoration: underline;
        }

        .error-message {
            background: #ffe0e0;
            border: 1px solid #ff9a9a;
            color: #a50000;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error-message ul {
            margin: 0;
            padding-left: 18px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 28px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Buat Akun Baru</h2>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            <label for="role">Register Sebagai</label>
            <select id="role" name="role" required>
                <option value="">-- Pilih Peran --</option>
                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
            </select>

            <label for="phone">Nomor Telepon</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <a href="{{ route('login') }}" class="login-link">Sudah punya akun? Login di sini</a>
    </div>
</body>
</html>
