<!-- barang.php -->
<?php
// Koneksi ke database (ubah sesuai dengan pengaturan Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'nota';

// Membuat koneksi
$connection = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$connection) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

?>