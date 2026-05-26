<?php
include '../koneksi.php';
if(!isset($_SESSION['id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php"); exit;
}

if(isset($_POST['tambah'])){
    $nama     = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jk       = $_POST['jenis_kelamin'];
    $kelas    = $_POST['kelas'];
    $jurusan  = $_POST['jurusan'];
    $role     = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (`username/email`, password, nama_lengkap, jenis_kelamin, kelas, jurusan, role)
    VALUES ('$username', '$password', '$nama', '$jk', '$kelas', '$jurusan', '$role')");

    header("Location: index.php?success=1");
}
?>