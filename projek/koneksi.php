<?php
$conn = mysqli_connect("localhost", "root", "", "2526_26db");
if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>