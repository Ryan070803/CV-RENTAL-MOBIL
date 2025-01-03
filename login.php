<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Menghubungkan ke database
include 'config/koneksi.php';

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM tbl_user_ryan WHERE username_ryan='$username' AND password_ryan='$password'";
    $result = mysqli_query($koneksi, $query);

    // Memeriksa hasil query
    if ($result === false) {
        die("Error: " . mysqli_error($koneksi)); // Menampilkan kesalahan query
    }

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center" style="height: 100vh;">
            <div class="col-md-4 my-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login</h5>
                        <?php if (isset($error)) echo "<div class='alert alert-danger' role='alert'>$error</div>"; ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>