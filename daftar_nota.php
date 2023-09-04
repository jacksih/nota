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
    
    <!-- Form Pencarian -->
    <form method="get" action="">
        <div class="form-group d-flex">
            <input type="text" class="form-control" name="search" placeholder="Cari Nota">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    
    <?php
    // Ambil data nota dari database
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    $sql_nota = "SELECT * FROM nota";
    
    // Cek jika ada pencarian
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql_nota .= " WHERE invoice LIKE '%$search%' OR namaPenerima LIKE '%$search%'";
    }
    
    $sql_nota .= " LIMIT $limit OFFSET $offset";
    
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
    
        // Pagination
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql_total = "SELECT COUNT(*) as total FROM nota";
        
        // Cek jika ada pencarian
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $sql_total .= " WHERE invoice LIKE '%$search%' OR namaPenerima LIKE '%$search%'";
        }
        
        $result_total = $conn->query($sql_total);
        $row_total = $result_total->fetch_assoc();
        $total_records = $row_total['total'];
        $total_pages = ceil($total_records / $limit);
        
        echo "<ul class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?page=$i";
            if (isset($_GET['search'])) {
                echo "&search=" . $_GET['search'];
            }
            echo "'>" . $i . "</a></li>";
        }
        echo "</ul>";
        
        $conn->close();
    } else {
        echo "Tidak ada nota yang tersimpan.";
    }
    
    // $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
