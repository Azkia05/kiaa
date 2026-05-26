<?php
include 'koneksi.php';

if(isset($_POST['register'])){
    $nama     = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jk       = $_POST['jenis_kelamin'];
    $kelas    = $_POST['kelas'];
    $jurusan  = $_POST['jurusan'];
    $role     = 'user';

    // Cek username sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE `username/email`='$username'");
    if(mysqli_num_rows($cek) > 0){
        header("Location: register.php?error=1");
        exit;
    }

    $query = mysqli_query($conn, "INSERT INTO users (`username/email`, password, nama_lengkap, jenis_kelamin, kelas, jurusan, role) 
    VALUES ('$username', '$password', '$nama', '$jk', '$kelas', '$jurusan', '$role')");

    if($query){
        header("Location: login.php?success=1");
    } else {
        header("Location: register.php?error=1");
    }
}
?>