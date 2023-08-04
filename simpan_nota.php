<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $_SESSION["tanggal"] = $_POST["tanggal"];
    $_SESSION["invoice"] = $_POST["invoice"];
    $_SESSION["pengirim"] = $_POST["pengirim"];
    $_SESSION["desa"] = $_POST["desa"];
    $_SESSION["kecamatan"] = $_POST["kecamatan"];
    $_SESSION["namaPenerima"] = $_POST["namaPenerima"];
    $_SESSION["alamatPenerima"] = $_POST["alamatPenerima"];
    $_SESSION["noHp"] = $_POST["noHp"];
    $_SESSION["jumlahPesanan"] = $_POST["jumlahPesanan"];

    // Redirect ke halaman daftar nota
    header("Location: transaksi.php");
    exit();
} else {
    echo "Metode permintaan tidak valid.";
}
?>
