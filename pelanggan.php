<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses tambah pelanggan
if (isset($_POST['tambah'])) {
    $nik_ktp = $_POST['nik_ktp'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO tbl_pelanggan_ryan (nik_ktp_ryan, nama_ryan, no_hp_ryan, alamat_ryan) VALUES ('$nik_ktp', '$nama', '$no_hp', '$alamat')";
    mysqli_query($koneksi, $query);
}

// Proses cari pelanggan
$search = '';
if (isset($_POST['cari'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM tbl_pelanggan_ryan WHERE nama_ryan LIKE '%$search%'";
} else {
    $query = "SELECT * FROM tbl_pelanggan_ryan";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
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
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Data Pelanggan</h1>
        
        <form action="" method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Pelanggan" value="<?php echo $search; ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="cari">Cari</button>
                </div>
            </div>
        </form>

        <form action="" method="POST" class="mb-4">
            <h2>Tambah Pelanggan</h2>
            <div class="form-group">
                <input type="text" name="nik_ktp" class="form-control" placeholder="NIK KTP" required>
            </div>
            <div class="form-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
            </div>
            <div class="form-group">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-custom">Tambah</button>
        </form>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>NIK KTP</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $data['nik_ktp_ryan']; ?></td>
                    <td><?php echo $data['nama_ryan']; ?></td>
                    <td><?php echo $data['no_hp_ryan']; ?></td>
                    <td><?php echo $data['alamat_ryan']; ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit_pelanggan.php?nik_ktp=<?php echo $data['nik_ktp_ryan']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete_pelanggan.php?nik_ktp=<?php echo $data['nik_ktp_ryan']; ?>">Delete</a>
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