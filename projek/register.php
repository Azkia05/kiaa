<!DOCTYPE html>
<html lang="id">
<head>
    <?php include 'koneksi.php'; ?>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="logo_tsc.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSC Register</title>
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
            display:flex; width:850px;
            border-radius:20px; overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,0.6);
        }
        .left {
            background: linear-gradient(135deg, #2a2a2a, #4a4a4a);
            width:40%;
            display:flex; flex-direction:column;
            justify-content:center; align-items:center;
            padding:40px; border-right:1px solid #555;
        }
        .left img { width:100px; height:100px; border-radius:50%; border:3px solid #888; margin-bottom:20px; object-fit:cover; }
        .left h1 { color:#fff; font-size:22px; letter-spacing:3px; margin-bottom:8px; }
        .left .divider { width:50px; height:2px; background:linear-gradient(90deg,#888,#ccc); margin:12px auto; border-radius:2px; }
        .left p { color:#aaa; font-size:13px; text-align:center; line-height:1.6; }
        .left .since { color:#777; font-size:12px; letter-spacing:2px; margin-top:5px; }

        .right {
            background:#fff; width:60%;
            padding:35px 40px;
            display:flex; flex-direction:column; justify-content:center;
        }
        .right h2 { color:#1a1a1a; font-size:22px; margin-bottom:4px; }
        .right p.sub { color:#888; font-size:13px; margin-bottom:25px; }

        .input-group { margin-bottom:14px; }
        .input-group label { display:block; margin-bottom:5px; font-weight:600; color:#333; font-size:12px; letter-spacing:1px; }
        .input-group input, .input-group select {
            width:100%; padding:11px 14px;
            border:1.5px solid #ddd; border-radius:8px;
            background:#f8f8f8; font-size:14px; color:#333;
            transition:border 0.3s;
        }
        .input-group input:focus, .input-group select:focus { outline:none; border-color:#888; background:#fff; }

        .row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }

        .btn-submit {
            width:100%; padding:13px;
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            color:#fff; border:none; border-radius:8px;
            font-size:15px; font-weight:bold; cursor:pointer;
            transition:all 0.3s; letter-spacing:1px; margin-top:5px;
        }
        .btn-submit:hover { background:linear-gradient(135deg, #3a3a3a, #666); }
        .footer-text { margin-top:15px; font-size:13px; color:#888; text-align:center; }
        .footer-text a { color:#333; font-weight:bold; text-decoration:none; }
        .alert { padding:10px 15px; border-radius:8px; margin-bottom:15px; font-size:13px; }
        .alert-error { background:#fff0f0; color:#c00; border:1px solid #ffcccc; }
        .alert-success { background:#f0fff0; color:#060; border:1px solid #ccffcc; }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <img src="logo_tsc.jpg" alt="Logo TSC">
        <h1>TSC</h1>
        <div class="divider"></div>
        <p>Tourism Student Club</p>
        <p class="since">SINCE 2011</p>
    </div>

    <div class="right">
        <h2>Daftar Akun</h2>
        <p class="sub">Bergabung dengan Tourism Student Club</p>

        <?php
        if(isset($_GET['error'])) echo "<div class='alert alert-error'>❌ Username/email sudah dipakai!</div>";
        if(isset($_GET['success'])) echo "<div class='alert alert-success'>✓ Akun berhasil dibuat!</div>";
        ?>

        <form action="proses_register.php" method="POST">
            <div class="input-group">
                <label>NAMA LENGKAP</label>
                <input type="text" name="nama_lengkap" placeholder="Nama lengkap kamu" required>
            </div>
            <div class="input-group">
                <label>USERNAME / EMAIL</label>
                <input type="text" name="username" placeholder="Username atau email" required>
            </div>
            <div class="input-group">
                <label>PASSWORD</label>
                <input type="password" name="password" placeholder="Buat password" required>
            </div>
            <div class="row">
                <div class="input-group">
                    <label>JENIS KELAMIN</label>
                    <select name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>KELAS</label>
                    <input type="text" name="kelas" placeholder="Contoh: XI KS 1" required>
                </div>
            </div>
            <div class="input-group">
                <label>JURUSAN</label>
                <select name="jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Kuliner">Kuliner</option>
                    <option value="Teknik Jaringan Komputer dan Telekomunikasi">Teknik Jaringan Komputer dan Telekomunikasi</option>
                    <option value="Teknik Kimia Industri">Teknik Kimia Industri</option>
                    <option value="Kecantikan dan Spa">Kecantikan dan Spa</option>
                    <option value="Desain Produksi Busana">Desain Produksi Busana</option>
                </select>
            </div>
            <button type="submit" name="register" class="btn-submit">DAFTAR →</button>
        </form>

        <div class="footer-text">
            Sudah punya akun? <a href="login.php">Masuk sekarang</a>
        </div>
    </div>
</div>
</body>
</html>