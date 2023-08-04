<?php
// Koneksi ke database (ganti sesuai dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nota";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

require_once('tcpdf/tcpdf.php');

// Ambil ID nota dari parameter URL
if (isset($_GET["id"])) {
    $nota_id = $_GET["id"];
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Nota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Detail Nota</h1>
        <?php
        if ($result_nota->num_rows > 0) {
            $row_nota = $result_nota->fetch_assoc();
        ?>
            <div class="row">
                <div class="col-md-6">
                    <p>Tanggal Nota: <?= $row_nota["tanggal"] ?></p>
                    <p>Invoice: <?= $row_nota["invoice"] ?></p>
                    <p>Penanggung Jawab: <?= $row_nota["pengirim"] ?></p>
                    <p>Nama Penerima: <?= $row_nota["namaPenerima"] ?></p>
                </div>
                <div class="col-md-6">
                    <p>Desa: <?= $row_nota["desa"] ?></p>
                    <p>Kecamatan: <?= $row_nota["kecamatan"] ?></p>
                    <p>Alamat Penerima: <?= $row_nota["alamatPenerima"] ?></p>
                    <p>Telepon Penerima: <?= $row_nota["noHp"] ?></p>
                </div>
            </div>

            <?php
            if ($result_transaksi->num_rows > 0) {
            ?>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_transaksi = $result_transaksi->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row_transaksi["no"] ?></td>
                                    <td><?= $row_transaksi["deskripsi"] ?></td>
                                    <td><?= $row_transaksi["jumlah"] ?></td>
                                    <td><?= $row_transaksi["harga"] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo "<p>Tidak ada transaksi terkait.</p>";
            }

            // Tombol untuk mengunduh nota dalam format PDF
            echo "<form action='download_nota.php' method='post'>";
            echo "<input type='hidden' name='nota_id' value='" . $nota_id . "'>";
            echo "<input type='submit' value='Unduh Nota PDF' class='btn btn-primary mt-3'>";
            echo "</form>";
        } else {
            echo "<p>Nota tidak ditemukan.</p>";
        }

        $conn->close();
        ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
