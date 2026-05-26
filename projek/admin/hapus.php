<?php
include '../koneksi.php';
if(!isset($_SESSION['id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php"); exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
header("Location: index.php");
?>