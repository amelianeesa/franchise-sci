<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Info Akun Tenaga Ahli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dddddd;
        }
        h2 {
            color: #0056b3;
            margin-top: 0;
        }
        .login-box {
            background: #ffffff;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #cccccc;
            margin: 20px 0;
        }
        .login-box p {
            margin: 5px 0;
        }
        .password-tag {
            background: #e9ecef;
            padding: 3px 6px;
            font-family: monospace;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo, {{ $user->name }}!</h2>
        
        <p>Akun Tenaga Ahli Anda untuk sistem PT Sucofindo telah berhasil dibuat oleh admin.</p>
        
        <p>Berikut adalah informasi data login Anda untuk mengakses sistem:</p>
        
        <div class="login-box">
            <p><strong>Username:</strong> {{ $user->username ?? $user->email }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Password Sementara:</strong> <span class="password-tag">{{ $password }}</span></p>
        </div>

        <p>Silakan gunakan informasi di atas untuk masuk ke halaman login aplikasi. Demi keamanan, Anda disarankan untuk segera mengganti password setelah berhasil masuk.</p>
        
        <div class="footer">
            Salam hormat,<br><strong>Admin PT Sucofindo</strong>
        </div>
    </div>
</body>
</html>