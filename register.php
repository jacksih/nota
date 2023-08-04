<!-- register.php -->
<?php
// Koneksi ke database (ubah sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Fungsi untuk melakukan pendaftaran akun
function register($nama, $email, $username, $password) {
    global $connection;

    // Lakukan validasi atau pemeriksaan apakah username sudah ada
    $query = "SELECT * FROM users WHERE username = '$username'";
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return false; // Username sudah digunakan
    }

    // Jika username belum digunakan, lakukan proses pendaftaran akun
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama, email, username, password) VALUES ('$nama', '$email', '$username', '$hashed_password')";
    $result = mysqli_query($connection, $query);

    return $result;
}

// Proses registrasi jika form telah disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $registration_result = register($nama, $email, $username, $password);
    if ($registration_result) {
        // Redirect ke halaman login
        header("Location: login.php");
        exit(); // Pastikan untuk keluar setelah redirect
    } else {
        echo "Registrasi gagal! Username sudah digunakan.";
    }
}

// Menutup koneksi setelah selesai
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registrasi</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="register.php">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="submit" value="Daftar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS (Popper.js dan Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
