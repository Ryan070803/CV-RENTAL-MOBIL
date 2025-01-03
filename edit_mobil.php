<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data mobil berdasarkan nomor plat
if (isset($_GET['no_plat'])) {
    $no_plat = $_GET['no_plat'];
    $query = "SELECT * FROM tbl_mobil_ryan WHERE no_plat_ryan='$no_plat'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}

// Proses untuk update mobil
if (isset($_POST['update'])) {
    $no_plat = $_POST['no_plat'];
    $nama_mobil = $_POST['nama_mobil'];
    $brand_mobil = $_POST['brand_mobil'];
    $tipe_transmisi = $_POST['tipe_transmisi'];

    // Update data mobil di database
    $query = "UPDATE tbl_mobil_ryan SET nama_mobil_ryan='$nama_mobil', brand_mobil_ryan='$brand_mobil', tipe_transmisi_ryan='$tipe_transmisi' WHERE no_plat_ryan='$no_plat'";
    mysqli_query($koneksi, $query);
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Edit Mobil</h1>
        <form action="" method="POST">
            <input type="hidden" name="no_plat" value="<?php echo htmlspecialchars($data['no_plat_ryan']); ?>">
            <div class="form-group">
                <label for="nama_mobil">Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" value="<?php echo htmlspecialchars($data['nama_mobil_ryan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="brand_mobil">Brand Mobil</label>
                <input type="text" name="brand_mobil" class="form-control" value="<?php echo htmlspecialchars($data['brand_mobil_ryan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tipe_transmisi">Tipe Transmisi</label>
                <input type="text" name="tipe_transmisi" class="form-control" value="<?php echo htmlspecialchars($data['tipe_transmisi_ryan']); ?>" required>
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