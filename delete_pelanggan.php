<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses penghapusan pelanggan
if (isset($_GET['nik_ktp'])) {
    $nik_ktp = $_GET['nik_ktp'];

    // Query untuk menghapus data pelanggan
    $query = "DELETE FROM tbl_pelanggan_ryan WHERE nik_ktp_ryan='$nik_ktp'";
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman pelanggan setelah berhasil menghapus
        header("Location: pelanggan.php");
        exit();
    } else {
        // Jika terjadi kesalahan pada query
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>