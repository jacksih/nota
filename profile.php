<!-- profile.php -->
<?php
// Mulai sesi
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login atau belum
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        // Jika pengguna belum login, arahkan kembali ke halaman login
        header("Location: login.php");
        exit();
    }
}

// Panggil fungsi check_login untuk memastikan pengguna sudah login sebelum mengakses halaman ini
check_login();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
    <!-- CSS dan lainnya di sini -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar_user.php' ?>
    <h1>Profil Pengguna</h1>
    <p>Informasi profil pengguna:</p>
    <ul>
        <li><strong>Nama:</strong> <?php echo $_SESSION['user_nama']; ?></li>
        <li><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></li>
        <li><strong>Username:</strong> <?php echo $_SESSION['user_username']; ?></li>
    </ul>

    <a href="edit_profile.php">Edit Profil</a> <!-- Tautan untuk mengedit profil -->
    <a href="logout.php">Logout</a> <!-- Tombol logout -->

    <!-- Tambahkan fitur lainnya yang sesuai dengan profil pengguna -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
