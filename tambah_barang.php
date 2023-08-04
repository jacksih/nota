<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Add custom style here */
        body {
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group small {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <form method="post" action="process_tambah_barang.php">
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="form-group">
                <label for="gambar">Link Gambar:</label>
                <input type="url" class="form-control" id="gambar" name="gambar" required>
                <small class="form-text text-muted">Masukkan URL gambar (contoh: https://www.example.com/gambar.jpg)</small>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>
        <br>
        <a href="barang_admin.php">Kembali ke Menu Tambah Barang</a>
    </div>

    <!-- Load Bootstrap JS (Popper.js dan Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
