
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pencucian Mobil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            width: 80px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1e3c72;
            margin-bottom: 10px;
        }
        p {
            color: #444;
            margin-bottom: 30px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .btn {
            padding: 12px 32px;
            border: none;
            border-radius: 8px;
            background: #1e3c72;
            color: #fff;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(30,60,114,0.12);
            transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
        }
        .btn:hover {
            background: #2a5298;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 24px rgba(30,60,114,0.18);
        }
        .footer {
            margin-top: 40px;
            color: #888;
            font-size: 0.95em;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h1>Manajemen Pencucian Mobil</h1>
        <p>
            Selamat datang di sistem manajemen pencucian mobil!<br>
            Kelola pelanggan, jadwal, dan layanan pencucian mobil Anda dengan mudah dan efisien.
        </p>
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </div>
   
</body>
</html>
