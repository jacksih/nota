<!-- process_login.php -->
<?php
// Koneksi ke database (ubah sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Proses login jika form telah disubmit

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password sesuai dengan data admin di database
    $query_admin = "SELECT * FROM users WHERE username = 'admin'";
    $result_admin = mysqli_query($connection, $query_admin);
    
    // Cek apakah username dan password sesuai dengan data user di database
    $query_user = "SELECT * FROM users WHERE username = '$username'";
    $result_user = mysqli_query($connection, $query_user);

    if (($result_admin && mysqli_num_rows($result_admin) > 0) && $username === "admin") {
        $admin = mysqli_fetch_assoc($result_admin);
        if (password_verify($password, $admin['password'])) {
            // Jika username adalah "admin", arahkan ke halaman admin
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } elseif ($result_user && mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        if (password_verify($password, $user['password'])) {
            // Jika bukan "admin", arahkan ke halaman user
            header("Location: user_dashboard.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }
}

// Menutup koneksi setelah selesai
mysqli_close($connection);
?>
