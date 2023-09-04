<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<?php include 'nav.php' ?>

<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <?php include 'sidebar_admin.php' ?>

        <!-- Main content -->
        <div class="col-md-8">
            <h2>Daftar Barang</h2>
            <form method="get" action="">
                <div class="form-group d-flex ">
                    <input type="text" class="form-control mb-3" name="search" placeholder="Cari Barang">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
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

                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $limit = 10;
                    $offset = ($page - 1) * $limit;

                    // Query untuk mendapatkan data barang dari tabel "barang"
                    $sql = "SELECT * FROM barang";
                    
                    // Cek jika ada pencarian
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql .= " WHERE nama_barang LIKE '%$search%'";
                    }
                    
                    $sql .= " LIMIT $limit OFFSET $offset";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["nama_barang"] . "</td>";
                            echo "<td><img src='" . $row["gambar"] . "' width='100'></td>";
                            echo "<td>Rp " . number_format($row["harga"], 0, ",", ".") . "</td>";
                            echo "<td>
                                    <a href='edit_barang.php?id_barang=" . $row["id_barang"] . "' class='btn btn-primary'>Edit</a>
                                    <a href='hapus_barang.php?id_barang=" . $row["id_barang"] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus barang ini?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data barang.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
            
            <?php
            // Pagination
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT COUNT(*) as total FROM barang";
            
            // Cek jika ada pencarian
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $sql .= " WHERE nama_barang LIKE '%$search%'";
            }
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_records = $row['total'];
            $total_pages = ceil($total_records / $limit);
            
            echo "<ul class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=$i'>" . $i . "</a></li>";
            }
            echo "</ul>";
            
            $conn->close();
            ?>
            
            <a href="tambah_barang.php" class="btn btn-success">Tambah Barang Baru</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
