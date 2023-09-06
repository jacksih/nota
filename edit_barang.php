<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #0f0122;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            color: #fff;
        }

        h1 {
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h1 class="text-center">Edit Barang</h1>
                <?php
                if (isset($_GET['id_barang'])) {
                    $id = $_GET['id_barang'];

                    // Koneksi ke database (ganti sesuai dengan informasi database Anda)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nota";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan data barang berdasarkan ID
                    $sql = "SELECT * FROM barang WHERE id_barang='$id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Tampilkan form untuk mengedit data barang
                        ?>
                        <form method="post" action="proces_edit_barang.php">
                            <input type="hidden" name="id_barang" value="<?php echo $row["id_barang"]; ?>">
                            <div class="form-group">
                                <label for="nama">Nama Barang:</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $row["nama_barang"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">URL Gambar:</label>
                                <input type="text" id="gambar" name="gambar" class="form-control" value="<?php echo $row["gambar"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo $row["harga"]; ?>" required>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                            </div>
                        </form>
                        <br>
                        <p class="text-center">
                            <a href="barang_Admin.php" class="btn btn-secondary">Kembali ke Daftar Barang</a>
                        </p>
                        <?php
                    } else {
                        echo "Data barang tidak ditemukan.";
                    }

                    $conn->close();
                } else {
                    echo "No ID parameter found.";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
