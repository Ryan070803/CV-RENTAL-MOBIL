<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['no_plat'])) {
    $no_plat = $_GET['no_plat'];
    $query = "DELETE FROM tbl_mobil_ryan WHERE no_plat_ryan='$no_plat'";
    mysqli_query($koneksi, $query);
    header("Location: mobil.php");
}
?>