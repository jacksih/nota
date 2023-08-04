<?php
if(isset($_GET['id_barang'])) {
    $id = $_GET['id_barang'];

    // Koneksi ke database (ganti sesuai dengan informasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nota";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menghapus data barang berdasarkan ID
    $sql = "DELETE FROM barang WHERE id_barang='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman daftar barang setelah data berhasil dihapus
        header("Location: barang_admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "No ID parameter found.";
}
?>
