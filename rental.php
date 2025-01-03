<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses untuk menyimpan data rental
if (isset($_POST['simpan'])) {
    $nik_ktp = $_POST['nik_ktp'];
    $no_plat = $_POST['no_plat'];
    $tgl_rental = $_POST['tgl_rental'];
    $jam_rental = $_POST['jam_rental'];
    $lama = $_POST['lama'];

    // Ambil harga per hari dari tabel mobil
    $query_harga = "SELECT harga_ryan FROM tbl_mobil_ryan WHERE no_plat_ryan='$no_plat'";
    $result_harga = mysqli_query($koneksi, $query_harga);
    $data_harga = mysqli_fetch_assoc($result_harga);
    $harga_per_hari = $data_harga['harga_ryan'];

    $total_bayar = $harga_per_hari * $lama;

    $query = "INSERT INTO tbl_rental_ryan (nik_ktp_ryan, no_plat_ryan, tgl_rental_ryan, jam_rental_ryan, lama_ryan, total_bayar_ryan) VALUES ('$nik_ktp', '$no_plat', '$tgl_rental', '$jam_rental', '$lama', '$total_bayar')";
    mysqli_query($koneksi, $query);
}

// Menampilkan data rental
$query = "SELECT * FROM tbl_rental_ryan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rental</title>
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
        <h1 class="mb-4 text-center">Data Rental</h1>

        <form action="" method="POST" class="mb-4">
            <h2>Tambah Rental</h2>
            <div class="form-group">
                <label for="nik_ktp">NIK KTP</label>
                <input type="text" name="nik_ktp" class="form-control" placeholder="NIK KTP" required>
            </div>
            <div class="form-group">
                <label for="no_plat">No Plat Mobil</label>
                <input type="text" name="no_plat" class="form-control" placeholder="No Plat" required>
            </div>
            <div class="form-group">
                <label for="tgl_rental">Tanggal Rental</label>
                <input type="date" name="tgl_rental" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jam_rental">Jam Rental</label>
                <input type="time" name="jam_rental" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lama">Lama Rental (Hari)</label>
                <input type="number" name="lama" class="form-control" placeholder="Lama Rental" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-custom">Simpan</button>
        </form>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>NIK KTP</th>
                    <th>No Plat</th>
                    <th>Tanggal Rental</th>
                    <th>Jam Rental</th>
                    <th>Lama (Hari)</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $data['nik_ktp_ryan']; ?></td>
                    <td><?php echo $data['no_plat_ryan']; ?></td>
                    <td><?php echo $data['tgl_rental_ryan']; ?></td>
                    <td><?php echo $data['jam_rental_ryan']; ?></td>
                    <td><?php echo $data['lama_ryan']; ?></td>
                    <td><?php echo number_format($data['total_bayar_ryan'], 0, ',', '.'); ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit_rental.php?id=<?php echo $data['id_rental']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete_rental.php?id=<?php echo $data['id_rental']; ?>">Delete</a>
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