<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses tambah mobil
if (isset($_POST['tambah'])) {
    $no_plat = $_POST['no_plat'];
    $nama_mobil = $_POST['nama_mobil'];
    $brand_mobil = $_POST['brand_mobil'];
    $tipe_transmisi = $_POST['tipe_transmisi'];

    $query = "INSERT INTO tbl_mobil_ryan (no_plat_ryan, nama_mobil_ryan, brand_mobil_ryan, tipe_transmisi_ryan) VALUES ('$no_plat', '$nama_mobil', '$brand_mobil', '$tipe_transmisi')";
    mysqli_query($koneksi, $query);
}

// Proses cari mobil
$search = '';
if (isset($_POST['cari'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM tbl_mobil_ryan WHERE nama_mobil_ryan LIKE '%$search%'";
} else {
    $query = "SELECT * FROM tbl_mobil_ryan";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        h1, h2 {
            color: #343a40;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Data Mobil</h1>
        
        <form action="" method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Mobil" value="<?php echo $search; ?>">
                <div class="input-group-append">
                    <button class="btn btn-custom" type="submit" name="cari">Cari</button>
                </div>
            </div>
        </form>

        <form action="" method="POST" class="mb-4">
            <h2>Tambah Mobil</h2>
            <div class="form-group">
                <input type="text" name="no_plat" class="form-control" placeholder="No Plat" required>
            </div>
            <div class="form-group">
                <input type="text" name="nama_mobil" class="form-control" placeholder="Nama Mobil" required>
            </div>
            <div class="form-group">
                <input type="text" name="brand_mobil" class="form-control" placeholder="Brand Mobil" required>
            </div>
            <div class="form-group">
                <input type="text" name="tipe_transmisi" class="form-control" placeholder="Tipe Transmisi" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-custom">Tambah</button>
        </form>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No Plat</th>
                    <th>Nama Mobil</th>
                    <th>Brand</th>
                    <th>Tipe Transmisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $data['no_plat_ryan']; ?></td>
                    <td><?php echo $data['nama_mobil_ryan']; ?></td>
                    <td><?php echo $data['brand_mobil_ryan']; ?></td>
                    <td><?php echo $data['tipe_transmisi_ryan']; ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit_mobil.php?no_plat=<?php echo $data['no_plat_ryan']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete_mobil.php?no_plat=<?php echo $data['no_plat_ryan']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>