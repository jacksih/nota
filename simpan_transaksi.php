<?php
session_start();

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

    $jumlahPesanan = $_SESSION["jumlahPesanan"];
    $transaksi = $_POST["no"];
    $deskripsi = $_POST["deskripsi"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];

    // Ambil data nota dari session
    $tanggal = $_SESSION["tanggal"];
    $invoice = $_SESSION["invoice"];
    $namaPenerima = $_SESSION["namaPenerima"];
    $alamatPenerima = $_SESSION["alamatPenerima"];
    $noHp = $_SESSION["noHp"];
    $pengirim = $_SESSION["pengirim"];
    $desa = $_SESSION["desa"];
    $kecamatan = $_SESSION["kecamatan"];

    // Simpan data header nota ke database
    $sql_nota = "INSERT INTO nota (tanggal, invoice, pengirim, desa, kecamatan, namaPenerima, alamatPenerima, noHp, jumlahPesanan) VALUES ('$tanggal', '$invoice', '$pengirim', '$desa', '$kecamatan', '$namaPenerima', '$alamatPenerima', '$noHp', '$jumlahPesanan')";
    if ($conn->query($sql_nota) !== TRUE) {
        echo "Error: " . $sql_nota . "<br>" . $conn->error;
        exit;
    }

    // Dapatkan ID nota yang baru saja disimpan
    $nota_id = $conn->insert_id;

    // Simpan data transaksi ke database
    $no = $_POST["no"];
    $deskripsi = $_POST["deskripsi"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];
    $jumlahTransaksi = count($no);

    if ($jumlahTransaksi > 0) {
        $sql_transaksi = "INSERT INTO transaksi (nota_id, no, deskripsi, jumlah, harga) VALUES ";

        for ($i = 0; $i < $jumlahTransaksi; $i++) {
            $sql_transaksi .= "('$nota_id', '$no[$i]', '$deskripsi[$i]', '$jumlah[$i]', '$harga[$i]')";
            if ($i < $jumlahTransaksi - 1) {
                $sql_transaksi .= ", ";
            }
        }

        if ($conn->query($sql_transaksi) !== TRUE) {
            echo "Error: " . $sql_transaksi . "<br>" . $conn->error;
            exit;
        }
    }

    // Hapus data nota dan transaksi dari session
    unset($_SESSION["tanggal"]);
    unset($_SESSION["invoice"]);
    unset($_SESSION["namaPenerima"]);
    unset($_SESSION["jumlahPesanan"]);

    $conn->close();

    // Redirect ke halaman daftar nota
    header("Location: daftar_nota.php");
    exit();
} else {
    echo "Metode permintaan tidak valid.";
}
?>
