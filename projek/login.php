<!DOCTYPE html>
<html lang="id">
<head>
    <?php include 'koneksi.php'; ?>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="logo_tsc.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSC Login</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI',sans-serif;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
            url('about tsc.jpg') center/cover no-repeat fixed;
            min-height:100vh;
            display:flex; justify-content:center; align-items:center;
        }
        .container {
            display:flex;
            width:850px;
            min-height:500px;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,0.6);
        }
        /* KIRI - ABU GELAP */
        .left {
            background: linear-gradient(135deg, #2a2a2a, #4a4a4a);
            width:45%;
            display:flex; flex-direction:column;
            justify-content:center; align-items:center;
            padding:40px;
            border-right:1px solid #555;
        }
        .left img { width:110px; height:110px; border-radius:50%; border:3px solid #888; margin-bottom:20px; object-fit:cover; }
        .left h1 { color:#fff; font-size:22px; letter-spacing:3px; margin-bottom:8px; }
        .left p { color:#aaa; font-size:13px; text-align:center; line-height:1.6; }
        .left .divider { width:50px; height:2px; background:linear-gradient(90deg,#888,#ccc); margin:15px auto; border-radius:2px; }
        .left .since { color:#777; font-size:12px; letter-spacing:2px; }

        /* KANAN - PUTIH */
        .right {
            background:#fff;
            width:55%;
            padding:45px 40px;
            display:flex; flex-direction:column; justify-content:center;
        }
        .right h2 { color:#1a1a1a; font-size:24px; margin-bottom:5px; }
        .right p.sub { color:#888; font-size:14px; margin-bottom:30px; }
        .input-group { margin-bottom:18px; }
        .input-group label { display:block; margin-bottom:6px; font-weight:600; color:#333; font-size:13px; letter-spacing:1px; }
        .input-group input {
            width:100%; padding:12px 15px;
            border:1.5px solid #ddd; border-radius:8px;
            background:#f8f8f8; font-size:14px; color:#333;
            transition:border 0.3s;
        }
        .input-group input:focus { outline:none; border-color:#888; background:#fff; }
        .btn-submit {
            width:100%; padding:13px;
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            color:#fff; border:none; border-radius:8px;
            font-size:15px; font-weight:bold; cursor:pointer;
            transition:all 0.3s; letter-spacing:1px;
        }
        .btn-submit:hover { background:linear-gradient(135deg, #3a3a3a, #666); }
        .footer-text { margin-top:20px; font-size:13px; color:#888; text-align:center; }
        .footer-text a { color:#333; font-weight:bold; text-decoration:none; }
        .footer-text a:hover { color:#000; }
        .alert { padding:10px 15px; border-radius:8px; margin-bottom:15px; font-size:13px; }
        .alert-error { background:#fff0f0; color:#c00; border:1px solid #ffcccc; }
        .alert-success { background:#f0fff0; color:#060; border:1px solid #ccffcc; }
    </style>
</head>
<body>
<div class="container">
    <!-- KIRI -->
    <div class="left">
        <img src="logo_tsc.jpg" alt="Logo TSC">
        <h1>TSC</h1>
        <div class="divider"></div>
        <p>Tourism Student Club</p>
        <p class="since">SINCE 2011</p>
    </div>

    <!-- KANAN -->
    <div class="right">
        <h2>Selamat Datang!</h2>
        <p class="sub">Masuk ke akun TSC kamu</p>

        <?php
        if(isset($_GET['error'])) echo "<div class='alert alert-error'>❌ Username/password salah!</div>";
        if(isset($_GET['success'])) echo "<div class='alert alert-success'>✓ Akun berhasil dibuat! Silakan login.</div>";
        ?>

        <form action="proses_login.php" method="POST">
            <div class="input-group">
                <label>USERNAME / EMAIL</label>
                <input type="text" name="username" placeholder="Masukkan username atau email" required>
            </div>
            <div class="input-group">
                <label>PASSWORD</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login" class="btn-submit">MASUK →</button>
        </form>

        <div class="footer-text">
            Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>
    </div>
</div>
</body>
</html>