<?php include '../koneksi.php';
if(!isset($_SESSION['id'])) { header("Location: ../login.php"); exit; }
if($_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - TSC</title>
    <link rel="icon" type="image/jpg" href="../logo_tsc.jpg">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',sans-serif; background:#f2f2f2; color:#222; min-height:100vh; }
        .navbar {
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            padding:15px 30px;
            display:flex; justify-content:space-between; align-items:center;
            border-bottom:3px solid #666;
            box-shadow:0 2px 20px rgba(0,0,0,0.4);
            position:sticky; top:0; z-index:100;
        }
        .navbar-left { display:flex; align-items:center; gap:12px; }
        .navbar-left img { width:42px; height:42px; border-radius:50%; border:2px solid #aaa; object-fit:cover; }
        .navbar-left h1 { font-size:18px; color:#fff; letter-spacing:2px; }
        .navbar-left span { font-size:11px; color:#aaa; display:block; }
        .navbar-right { display:flex; align-items:center; gap:15px; font-size:14px; color:#ccc; }
        .navbar-right a {
            color:#fff; text-decoration:none;
            background:#444; padding:8px 18px;
            border-radius:20px; border:1px solid #777; transition:all 0.3s;
        }
        .navbar-right a:hover { background:#666; }
        .container { padding:35px 40px; }
        .welcome {
            background:linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                url('../../Tourism Student Club/img/about tsc.jpg') center/cover no-repeat;
            padding:30px; border-radius:16px; margin-bottom:25px;
            display:flex; justify-content:space-between; align-items:center;
            box-shadow:0 4px 15px rgba(0,0,0,0.2);
        }
        .welcome h2 { font-size:20px; color:#fff; margin-bottom:5px; }
        .welcome p { color:#ccc; font-size:13px; }
        .badge-admin {
            background:rgba(255,255,255,0.15);
            color:#fff; padding:8px 20px; border-radius:20px;
            font-size:12px; border:1px solid rgba(255,255,255,0.4);
            letter-spacing:2px; backdrop-filter:blur(5px);
        }
        .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:15px; margin-bottom:25px; }
        .stat-card {
            background:#fff; padding:20px; border-radius:12px; text-align:center;
            border:1px solid #ddd; box-shadow:0 2px 10px rgba(0,0,0,0.06);
            transition:transform 0.2s;
        }
        .stat-card:hover { transform:translateY(-3px); }
        .stat-card h3 { font-size:32px; color:#1a1a1a; }
        .stat-card p { color:#888; font-size:13px; margin-top:5px; }
        .table-wrapper {
            background:#fff; border-radius:16px;
            overflow:hidden; border:1px solid #ddd;
            box-shadow:0 2px 15px rgba(0,0,0,0.06);
        }
        .table-header {
            padding:18px 25px;
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            display:flex; justify-content:space-between; align-items:center;
        }
        .table-header h3 { font-size:15px; color:#fff; letter-spacing:1px; }
        .header-right { display:flex; gap:10px; align-items:center; }
        .search-input {
            padding:8px 15px; border-radius:20px;
            border:1px solid #555; background:#2a2a2a;
            color:#fff; font-size:13px; width:200px; outline:none;
        }
        .search-input::placeholder { color:#888; }
        .btn-tambah {
            background:#fff; color:#1a1a1a;
            padding:8px 18px; border-radius:20px;
            font-size:13px; font-weight:bold;
            text-decoration:none; border:none; cursor:pointer;
            transition:all 0.3s; white-space:nowrap;
        }
        .btn-tambah:hover { background:#ddd; }
        table { width:100%; border-collapse:collapse; }
        th {
            background:#f5f5f5; padding:13px 20px; text-align:left;
            color:#555; font-size:12px; letter-spacing:1px; text-transform:uppercase;
            border-bottom:2px solid #eee;
        }
        td { padding:13px 20px; color:#333; border-bottom:1px solid #f0f0f0; font-size:14px; }
        tr:hover td { background:#fafafa; }
        tr:last-child td { border-bottom:none; }
        .role-admin { background:linear-gradient(135deg,#333,#555); color:#fff; padding:4px 12px; border-radius:20px; font-size:12px; }
        .role-user { background:#f0f0f0; color:#777; padding:4px 12px; border-radius:20px; font-size:12px; border:1px solid #ddd; }
        .btn { padding:7px 16px; border-radius:8px; border:none; cursor:pointer; font-size:13px; text-decoration:none; transition:all 0.2s; }
        .btn-edit { background:#333; color:#fff; }
        .btn-edit:hover { background:#555; }
        .btn-hapus { background:#fff; color:#c00; border:1px solid #c00; }
        .btn-hapus:hover { background:#c00; color:#fff; }
        .success-msg { background:#f0fff0; color:#2a7a2a; padding:12px 20px; border-radius:8px; margin-bottom:20px; border:1px solid #b0dbb0; font-size:14px; }

        /* MODAL */
        .modal-overlay {
            display:none; position:fixed; top:0; left:0;
            width:100%; height:100%; background:rgba(0,0,0,0.6);
            z-index:999; justify-content:center; align-items:center;
        }
        .modal-overlay.active { display:flex; }
        .modal {
            background:#fff; border-radius:16px; padding:35px;
            width:100%; max-width:480px;
            box-shadow:0 20px 60px rgba(0,0,0,0.4);
            max-height:90vh; overflow-y:auto;
        }
        .modal h3 { font-size:20px; color:#1a1a1a; margin-bottom:5px; }
        .modal p.sub { color:#888; font-size:13px; margin-bottom:25px; }
        .input-group { margin-bottom:14px; }
        .input-group label { display:block; margin-bottom:5px; font-weight:600; color:#333; font-size:12px; letter-spacing:1px; }
        .input-group input, .input-group select {
            width:100%; padding:11px 14px;
            border:1.5px solid #ddd; border-radius:8px;
            background:#f8f8f8; font-size:14px; color:#333; transition:border 0.3s;
        }
        .input-group input:focus, .input-group select:focus { outline:none; border-color:#888; background:#fff; }
        .row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .modal-footer { display:flex; gap:10px; margin-top:20px; }
        .btn-save {
            flex:1; padding:12px;
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            color:#fff; border:none; border-radius:8px;
            font-size:14px; font-weight:bold; cursor:pointer; transition:all 0.3s;
        }
        .btn-save:hover { background:linear-gradient(135deg, #3a3a3a, #666); }
        .btn-cancel {
            flex:1; padding:12px;
            background:#f0f0f0; color:#333;
            border:1px solid #ddd; border-radius:8px;
            font-size:14px; cursor:pointer; transition:all 0.3s;
        }
        .btn-cancel:hover { background:#ddd; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-left">
        <img src="../logo_tsc.jpg" alt="Logo TSC">
        <div>
            <h1>TSC Admin Panel</h1>
            <span>Tourism Student Club</span>
        </div>
    </div>
    <div class="navbar-right">
        Halo, <?= $_SESSION['nama'] ?>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <?php if(isset($_GET['success'])) echo "<div class='success-msg'>✓ Data berhasil disimpan!</div>"; ?>

    <div class="welcome">
        <div>
            <h2>Selamat datang, <?= $_SESSION['nama'] ?>!</h2>
            <p>Kelola data anggota Tourism Student Club</p>
        </div>
        <div class="badge-admin">ADMIN</div>
    </div>

    <?php
    $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='user'"));
    $totalAdmin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='admin'"));
    ?>
    <div class="stats">
        <div class="stat-card"><h3><?= $total ?></h3><p>Total Anggota</p></div>
        <div class="stat-card"><h3><?= $totalAdmin ?></h3><p>Total Admin</p></div>
        <div class="stat-card"><h3><?= $total + $totalAdmin ?></h3><p>Total User</p></div>
    </div>

    <div class="table-wrapper">
        <div class="table-header">
            <h3>Data Anggota TSC</h3>
            <div class="header-right">
                <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="🔍 Cari anggota...">
                <button class="btn-tambah" onclick="document.getElementById('modalTambah').classList.add('active')">+ Tambah Anggota</button>
            </div>
        </div>
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <th>Username/Email</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>JK</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            <?php
            $data = mysqli_query($conn, "SELECT * FROM users ORDER BY nama_lengkap ASC");
            while($row = mysqli_fetch_assoc($data)){
                $roleBadge = $row['role'] == 'admin'
                    ? "<span class='role-admin'>Admin</span>"
                    : "<span class='role-user'>User</span>";
                echo "<tr>
                    <td><strong>{$row['nama_lengkap']}</strong></td>
                    <td>{$row['username/email']}</td>
                    <td>{$row['kelas']}</td>
                    <td>{$row['jurusan']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>$roleBadge</td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                        <a href='hapus.php?id={$row['id']}' class='btn btn-hapus' onclick='return confirm(\"Hapus anggota ini?\")'>Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <h3>Tambah Anggota</h3>
        <p class="sub">Isi data anggota baru TSC</p>
        <form action="proses_tambah.php" method="POST">
            <div class="input-group">
                <label>NAMA LENGKAP</label>
                <input type="text" name="nama_lengkap" placeholder="Nama lengkap" required>
            </div>
            <div class="input-group">
                <label>USERNAME / EMAIL</label>
                <input type="text" name="username" placeholder="Username atau email" required>
            </div>
            <div class="input-group">
                <label>PASSWORD</label>
                <input type="password" name="password" placeholder="Password" required>
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
            <div class="input-group">
                <label>ROLE</label>
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="document.getElementById('modalTambah').classList.remove('active')">Batal</button>
                <button type="submit" name="tambah" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function searchTable(){
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('table tr:not(:first-child)');
    rows.forEach(function(row){
        var text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>

</body>
</html>