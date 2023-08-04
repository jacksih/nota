<?php
require_once('tcpdf/tcpdf.php');

// Koneksi ke database (ganti sesuai dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nota";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID nota dari form submit
if (isset($_POST["nota_id"])) {
    $nota_id = $_POST["nota_id"];
} else {
    echo "ID nota tidak ditemukan.";
    exit;
}

// Ambil data nota dari database berdasarkan ID nota
$sql_nota = "SELECT * FROM nota WHERE id = $nota_id";
$result_nota = $conn->query($sql_nota);

// Ambil data transaksi terkait dengan nota dari database
$sql_transaksi = "SELECT * FROM transaksi WHERE nota_id = $nota_id";
$result_transaksi = $conn->query($sql_transaksi);

// Buat objek TCPDF
$pdf = new TCPDF();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Tampilkan data nota dalam PDF
if ($result_nota->num_rows > 0) {
    $row_nota = $result_nota->fetch_assoc();

    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Detail Nota', 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Tanggal Nota: ' . $row_nota["tanggal"], 0, 1);
    $pdf->Cell(0, 10, 'Invoice: ' . $row_nota["invoice"], 0, 1);
    $pdf->Cell(0, 10, 'Penanggung Jawab: ' . $row_nota["pengirim"], 0, 1);
    $pdf->Cell(0, 10, 'Nama Penerima: ' . $row_nota["namaPenerima"], 0, 1);

    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(25, 10, 'No', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Deskripsi', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Harga', 1, 1, 'C');

    // Tampilkan data transaksi dalam PDF
    if ($result_transaksi->num_rows > 0) {
        while ($row_transaksi = $result_transaksi->fetch_assoc()) {
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(25, 10, $row_transaksi["no"], 1, 0, 'C');
            $pdf->Cell(80, 10, $row_transaksi["deskripsi"], 1, 0, 'C');
            $pdf->Cell(30, 10, $row_transaksi["jumlah"], 1, 0, 'C');
            $pdf->Cell(30, 10, $row_transaksi["harga"], 1, 1, 'C');
        }
    } else {
        $pdf->Cell(165, 10, 'Tidak ada transaksi terkait.', 1, 1, 'C');
    }
} else {
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Nota tidak ditemukan.', 0, 1, 'C');
}

// Output file PDF untuk diunduh
$pdf->Output('nota.pdf', 'D');

$conn->close();
?>
