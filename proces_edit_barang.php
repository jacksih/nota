<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database (ganti sesuai dengan informasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nota";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $id = $_POST["id_barang"];
    $nama = $_POST["nama"];
    $gambar = $_POST["gambar"];
    $harga = $_POST["harga"];

    // Query untuk mengupdate data barang berdasarkan ID
    $sql = "UPDATE barang SET nama_barang='$nama', gambar='$gambar', harga='$harga' WHERE id_barang='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman daftar barang setelah data berhasil diupdate
        header("Location: barang_admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Metode permintaan tidak valid.";
}
?>
