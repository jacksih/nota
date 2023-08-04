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

// Fungsi untuk mengambil jumlah transaksi pada nota berdasarkan ID nota
function countTransaksi($conn, $nota_id) {
    $sql = "SELECT COUNT(*) as total FROM transaksi WHERE nota_id = $nota_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["total"];
    } else {
        return 0;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Nota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php include 'navbar_user.php'; ?>

<div class="container mt-4">
    <h1>Daftar Nota</h1>
    <?php
    // Ambil data nota dari database
    $sql_nota = "SELECT * FROM nota";
    $result_nota = $conn->query($sql_nota);

    if ($result_nota->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>Tanggal Nota</th><th>Nomor Nota</th><th>Nama Pelanggan</th><th>Action</th></tr></thead>";
        echo "<tbody>";

        while ($row_nota = $result_nota->fetch_assoc()) {
            $nota_id = $row_nota["id"];
            $tanggal_nota = $row_nota["tanggal"];
            $invoice = $row_nota["invoice"];
            $namaPenerima = $row_nota["namaPenerima"];

            echo "<tr>";
            echo "<td>" . $tanggal_nota . "</td>";
            echo "<td>" . $invoice . "</td>";
            echo "<td>" . $namaPenerima . "</td>";
            echo "<td><a href='lihat_nota.php?id=" . $nota_id . "' target='_blank'>Lihat Nota</a></td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "Tidak ada nota yang tersimpan.";
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
