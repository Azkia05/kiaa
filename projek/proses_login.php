<?php
include 'koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE `username/email`='$username' AND password='$password'");

    if($query && mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        if($data['role'] == 'admin'){
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: login.php?error=1");
    }
}
?>