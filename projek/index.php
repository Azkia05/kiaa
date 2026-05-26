<?php include 'koneksi.php';
if(!isset($_SESSION['id'])) { header("Location: login.php"); exit; }
if($_SESSION['role'] == 'admin') { header("Location: admin/index.php"); exit; }

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$_SESSION['id']}'"));
$inisial = strtoupper(substr($user['nama_lengkap'], 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TSC</title>
    <link rel="icon" type="image/jpg" href="logo_tsc.jpg">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',sans-serif; background:#f0f0f0; color:#222; min-height:100vh; }
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
        .hero {
            background:linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                url('../Tourism Student Club/img/about tsc.jpg') center/cover no-repeat;
            padding:50px 40px;
            display:flex; justify-content:space-between; align-items:center;
        }
        .hero-left h2 { font-size:28px; color:#fff; margin-bottom:8px; }
        .hero-left p { color:#ccc; font-size:14px; }
        .badge-member {
            background:rgba(255,255,255,0.15);
            color:#fff; padding:10px 25px; border-radius:25px;
            font-size:13px; border:1px solid rgba(255,255,255,0.4);
            letter-spacing:3px; backdrop-filter:blur(5px);
        }
        .container { padding:30px 40px; }
        .profile-card {
            background:#fff; border-radius:16px; padding:0;
            margin-bottom:25px; border:1px solid #ddd;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
            overflow:hidden; display:flex;
        }
        .profile-left {
            background:linear-gradient(135deg, #1a1a1a, #3a3a3a);
            padding:30px 25px;
            display:flex; flex-direction:column;
            align-items:center; justify-content:center;
            min-width:180px;
        }
        .profile-avatar {
            width:75px; height:75px; border-radius:50%;
            background:linear-gradient(135deg, #555, #888);
            display:flex; align-items:center; justify-content:center;
            font-size:30px; color:#fff; font-weight:bold;
            margin-bottom:12px; border:3px solid #aaa;
        }
        .profile-left h3 { color:#fff; font-size:16px; text-align:center; }
        .profile-left span { color:#aaa; font-size:12px; margin-top:5px; letter-spacing:1px; }
        .profile-right {
            padding:25px 30px;
            display:grid; grid-template-columns:1fr 1fr;
            gap:15px; align-content:center; flex:1;
        }
        .info-item label { display:block; font-size:11px; color:#aaa; letter-spacing:1px; text-transform:uppercase; margin-bottom:4px; }
        .info-item p { font-size:14px; color:#222; font-weight:500; }
        .stats { display:grid; grid-template-columns:repeat(3,1fr); gap:15px; margin-bottom:25px; }
        .stat-card {
            background:#fff; padding:20px; border-radius:12px; text-align:center;
            border:1px solid #ddd; box-shadow:0 2px 10px rgba(0,0,0,0.06);
            transition:transform 0.2s;
        }
        .stat-card:hover { transform:translateY(-3px); }
        .stat-card h3 { font-size:30px; color:#1a1a1a; font-weight:bold; }
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
        .search-input {
            padding:8px 15px; border-radius:20px;
            border:1px solid #555; background:#2a2a2a;
            color:#fff; font-size:13px; width:200px; outline:none;
        }
        .search-input::placeholder { color:#888; }
        table { width:100%; border-collapse:collapse; }
        th {
            background:#f5f5f5; padding:13px 20px; text-align:left;
            color:#555; font-size:12px; letter-spacing:1px; text-transform:uppercase;
            border-bottom:2px solid #eee;
        }
        td { padding:13px 20px; color:#333; border-bottom:1px solid #f0f0f0; font-size:14px; }
        tr:hover td { background:#fafafa; }
        tr:last-child td { border-bottom:none; }
        .no { color:#aaa; font-size:13px; }
        .jk-badge { padding:4px 12px; border-radius:20px; font-size:12px; }
        .jk-l { background:#e0e0e0; color:#333; }
        .jk-p { background:#f0f0f0; color:#666; }
        .jurusan-badge {
            background:#f5f5f5; color:#444;
            padding:4px 10px; border-radius:6px;
            font-size:12px; border:1px solid #e0e0e0;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-left">
        <img src="logo_tsc.jpg" alt="Logo TSC">
        <div>
            <h1>TSC</h1>
            <span>Tourism Student Club</span>
        </div>
    </div>
    <div class="navbar-right">
        Halo, <?= $user['nama_lengkap'] ?>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="hero">
    <div class="hero-left">
        <h2>Selamat datang, <?= $user['nama_lengkap'] ?>! 👋</h2>
        <p>Kamu terdaftar sebagai anggota Tourism Student Club since 2011</p>
    </div>
    <div class="badge-member">MEMBER TSC</div>
</div>

<div class="container">
    <div class="profile-card">
        <div class="profile-left">
            <div class="profile-avatar"><?= $inisial ?></div>
            <h3><?= $user['nama_lengkap'] ?></h3>
            <span>MEMBER</span>
        </div>
        <div class="profile-right">
            <div class="info-item">
                <label>📧 Username/Email</label>
                <p><?= $user['username/email'] ?></p>
            </div>
            <div class="info-item">
                <label>📝 Nama Lengkap</label>
                <p><?= $user['nama_lengkap'] ?></p>
            </div>
            <div class="info-item">
                <label>🎓 Kelas</label>
                <p><?= $user['kelas'] ?></p>
            </div>
            <div class="info-item">
                <label>📚 Jurusan</label>
                <p><?= $user['jurusan'] ?></p>
            </div>
            <div class="info-item">
                <label>Jenis Kelamin</label>
                <p><?= $user['jenis_kelamin'] == 'L' ? '👨‍🎓 Laki-laki' : '👩‍🎓 Perempuan' ?></p>
            </div>
        </div>
    </div>

    <?php
    $totalAnggota = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='user'"));
    $totalJurusan = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT jurusan FROM users WHERE role='user'"));
    ?>
    <div class="stats">
        <div class="stat-card">
            <h3><?= $totalAnggota ?></h3>
            <p>Total Anggota</p>
        </div>
        <div class="stat-card">
            <h3><?= $totalJurusan ?></h3>
            <p>Jurusan</p>
        </div>
        <div class="stat-card">
            <h3>2011</h3>
            <p>Berdiri Sejak</p>
        </div>
    </div>

    <div class="table-wrapper">
        <div class="table-header">
            <h3>Daftar Anggota TSC</h3>
            <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="🔍 Cari anggota...">
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username/Email</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>JK</th>
            </tr>
            <?php
            $data = mysqli_query($conn, "SELECT * FROM users WHERE role='user' ORDER BY nama_lengkap ASC");
            $no = 1;
            while($row = mysqli_fetch_assoc($data)){
                $jk = $row['jenis_kelamin'] == 'L'
                    ? "<span class='jk-badge jk-l'>👨‍🎓 Laki-laki</span>"
                    : "<span class='jk-badge jk-p'>👩‍🎓 Perempuan</span>";
                echo "<tr>
                    <td class='no'>$no</td>
                    <td><strong>{$row['nama_lengkap']}</strong></td>
                    <td>{$row['username/email']}</td>
                    <td>{$row['kelas']}</td>
                    <td><span class='jurusan-badge'>{$row['jurusan']}</span></td>
                    <td>$jk</td>
                </tr>";
                $no++;
            }
            ?>
        </table>
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