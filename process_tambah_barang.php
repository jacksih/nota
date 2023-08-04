<?php
// Koneksi ke database (ubah sesuai dengan pengaturan Anda)
include 'koneksi.php';
// Proses tambah barang jika form telah disubmit
if (isset($_POST['nama_barang']) && isset($_POST['harga']) && isset($_POST['gambar'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    // Lakukan penambahan data barang ke dalam database
    $query = "INSERT INTO barang (nama_barang, harga, gambar) VALUES ('$nama', '$harga', '$gambar')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Redirect kembali ke halaman tambah_barang.php setelah submit berhasil
        header("Location: barang_admin.php");
        exit();
    } else {
        echo "Gagal menambahkan barang.";
    }
}

// Menutup koneksi setelah selesai
mysqli_close($connection);
?>
