<?php
$conn = mysqli_connect("localhost", "2526_26", "12345678", "2526_26db");
if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>