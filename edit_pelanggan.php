<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pelanggan berdasarkan NIK KTP
if (isset($_GET['nik_ktp'])) {
    $nik_ktp = $_GET['nik_ktp'];
    $query = "SELECT * FROM tbl_pelanggan_ryan WHERE nik_ktp_ryan='$nik_ktp'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}

// Proses untuk update pelanggan
if (isset($_POST['update'])) {
    $nik_ktp = $_POST['nik_ktp'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE tbl_pelanggan_ryan SET nama_ryan='$nama', no_hp_ryan='$no_hp', alamat_ryan='$alamat' WHERE nik_ktp_ryan='$nik_ktp'";
    mysqli_query($koneksi, $query);
    header("Location: pelanggan.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Edit Pelanggan</h1>
        <form action="" method="POST">
            <input type="hidden" name="nik_ktp" value="<?php echo htmlspecialchars($data['nik_ktp_ryan']); ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama_ryan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($data['no_hp_ryan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($data['alamat_ryan']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>
    <div class="text-center">
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>