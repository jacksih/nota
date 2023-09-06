<?php
include 'koneksi.php';

// Mendapatkan data barang dari database
$query = "SELECT * FROM barang";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-image: linear-gradient(120deg, #0f0122 0%, #1c1b3a 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        h1, h5 {
            color: #fff;
        }

        .btn {
            margin-top: 10px;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .table th {
            color: #fff;
            background-color: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <?php include 'navbar_user.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Barang</h1>
        <div class="row">
            <?php
            // Menampilkan data barang dalam bentuk card
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 mb-4 ">
                    <div class="shadow p-3 mb-5 rounded">
                        <img src="<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
                            <p class="card-text">Harga: Rp <?= number_format($row['harga'], 0, ",", ".") ?></p>
                            <!-- Tambahkan tombol atau tautan untuk aksi lainnya di sini -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
