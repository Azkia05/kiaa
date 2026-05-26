<?php include '../koneksi.php';
if(!isset($_SESSION['id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php"); exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));

if(isset($_POST['update'])){
    $nama    = $_POST['nama_lengkap'];
    $kelas   = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $jk      = $_POST['jenis_kelamin'];
    $role    = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET nama_lengkap='$nama', kelas='$kelas', jurusan='$jurusan', jenis_kelamin='$jk', role='$role' WHERE id='$id'");
    header("Location: index.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota - TSC</title>
    <link rel="icon" type="image/jpg" href="../logo_tsc.jpg">
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
            display:flex; width:750px;
            border-radius:20px; overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,0.6);
        }
        .left {
            background:linear-gradient(135deg, #2a2a2a, #4a4a4a);
            width:38%;
            display:flex; flex-direction:column;
            justify-content:center; align-items:center;
            padding:40px; border-right:1px solid #555;
        }
        .left img { width:90px; height:90px; border-radius:50%; border:3px solid #888; margin-bottom:20px; object-fit:cover; }
        .left h1 { color:#fff; font-size:20px; letter-spacing:3px; margin-bottom:8px; }
        .left .divider { width:50px; height:2px; background:linear-gradient(90deg,#888,#ccc); margin:12px auto; border-radius:2px; }
        .left p { color:#aaa; font-size:13px; text-align:center; }
        .left .since { color:#777; font-size:12px; letter-spacing:2px; margin-top:5px; }

        .right {
            background:#fff; width:62%;
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
        .btn-back {
            display:block; text-align:center;
            margin-top:15px; font-size:13px;
            color:#888; text-decoration:none;
        }
        .btn-back:hover { color:#333; }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <img src="../logo_tsc.jpg" alt="Logo TSC">
        <h1>TSC</h1>
        <div class="divider"></div>
        <p>Tourism Student Club</p>
        <p class="since">SINCE 2011</p>
    </div>

    <div class="right">
        <h2>Edit Anggota</h2>
        <p class="sub">Ubah data anggota TSC</p>

        <form method="POST">
            <div class="input-group">
                <label>NAMA LENGKAP</label>
                <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" required>
            </div>
            <div class="row">
                <div class="input-group">
                    <label>JENIS KELAMIN</label>
                    <select name="jenis_kelamin">
                        <option value="L" <?= $data['jenis_kelamin']=='L'?'selected':'' ?>>Laki-laki</option>
                        <option value="P" <?= $data['jenis_kelamin']=='P'?'selected':'' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>KELAS</label>
                    <input type="text" name="kelas" value="<?= $data['kelas'] ?>" required>
                </div>
            </div>
            <div class="input-group">
                <label>JURUSAN</label>
                <select name="jurusan">
                    <option value="Kuliner" <?= $data['jurusan']=='Kuliner'?'selected':'' ?>>Kuliner</option>
                    <option value="Teknik Jaringan Komputer dan Telekomunikasi" <?= $data['jurusan']=='Teknik Jaringan Komputer dan Telekomunikasi'?'selected':'' ?>>Teknik Jaringan Komputer dan Telekomunikasi</option>
                    <option value="Teknik Kimia Industri" <?= $data['jurusan']=='Teknik Kimia Industri'?'selected':'' ?>>Teknik Kimia Industri</option>
                    <option value="Kecantikan dan Spa" <?= $data['jurusan']=='Kecantikan dan Spa'?'selected':'' ?>>Kecantikan dan Spa</option>
                    <option value="Desain Produksi Busana" <?= $data['jurusan']=='Desain Produksi Busana'?'selected':'' ?>>Desain Produksi Busana</option>
                </select>
            </div>
            <div class="input-group">
                <label>ROLE</label>
                <select name="role">
                    <option value="user" <?= $data['role']=='user'?'selected':'' ?>>User</option>
                    <option value="admin" <?= $data['role']=='admin'?'selected':'' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn-submit">SIMPAN PERUBAHAN →</button>
        </form>
        <a href="index.php" class="btn-back">← Kembali</a>
    </div>
</div>
</body>
</html>