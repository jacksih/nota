<!-- edit_profile.php -->
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

// Koneksi ke database (ubah sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Proses pengeditan profil jika form telah disubmit
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Lakukan validasi atau pemeriksaan apakah username sudah ada (khusus jika username diubah)
    $query_username = "SELECT * FROM user WHERE username = '$username' AND id != $user_id";
    $result_username = mysqli_query($connection, $query_username);

    if ($result_username && mysqli_num_rows($result_username) > 0) {
        echo "Username sudah digunakan.";
    } else {
        // Jika username belum digunakan, lakukan proses pengeditan profil
        $query_update = "UPDATE user SET nama = '$nama', email = '$email', username = '$username' WHERE id = $user_id";
        $result_update = mysqli_query($connection, $query_update);

        if ($result_update) {
            echo "Profil berhasil diupdate.";
            // Redirect kembali ke halaman profile.php setelah pengeditan profil berhasil
            header("Location: profile.php");
            exit();
        } else {
            echo "Gagal mengedit profil.";
        }
    }
}

// Mendapatkan data profil pengguna dari database untuk menampilkan pada form
$user_id = $_SESSION['user_id'];
$query_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = mysqli_query($connection, $query_user);
$user_data = mysqli_fetch_assoc($result_user);

// Menutup koneksi setelah selesai
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>
    <!-- CSS dan lainnya di sini -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <h1>Edit Profil</h1>
    <form method="post" action="edit_profile.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $user_data['nama']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>" required><br>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
