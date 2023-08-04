<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Barang</h1>
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
                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
                <br>
                <a href="barang_Admin.php" class="btn btn-secondary">Kembali ke Daftar Barang</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
