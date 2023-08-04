<?php
include 'koneksi.php';
// Mendapatkan data barang dari database
$query = "SELECT * FROM barang";
$result = mysqli_query($connection, $query);
?>

<!-- barang.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Halaman Barang</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
  <?php include 'navbar_user.php'; ?>
  <!-- Konten halaman barang lainnya -->

  <!-- Konten halaman "Barang" di sini -->
  <h1>Daftar Barang</h1>
  <div class="row">
    <?php
    // Menampilkan data barang dalam bentuk card
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-md-2 mb-4">
        <div class="card">
          <img src="<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
            <p class="card-text"><?= $row['harga'] ?></p>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
