<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Koneksi ke database (ganti sesuai dengan informasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nota";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menghapus data user berdasarkan ID
    $sql = "DELETE FROM users WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman daftar user setelah data berhasil dihapus
        header("Location: admin_dashboard.php"); // Sesuaikan dengan halaman yang sesuai
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "No ID parameter found.";
}
?>
