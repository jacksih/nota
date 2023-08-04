<!DOCTYPE html>
<html>
<head>
    <title>Input Nota dan Barang</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Tambahkan gaya kustom di sini */
    </style>
</head>
<body>
    <div class="container">
        <h5>Input Nota dan Barang</h5>
        <?php
        if (isset($_POST['jumlah_pesanan'])) {
            $jumlah_pesanan = $_POST['jumlah_pesanan'];
        ?>
        <form method="post" action="process_input_nota.php">
            <div class="form-group">
                <label for="pengirim">Pengirim:</label>
                <input type="text" class="form-control" id="pengirim" name="pengirim" required>
            </div>

            <!-- Form input data nota lainnya (sesuai dengan form sebelumnya) -->
            <!-- ... -->

            <div class="form-group">
                <label for="invoice_nota">Invoice Nota:</label>
                <input type="text" class="form-control" id="invoice_nota" name="invoice_nota" value="<?php echo $invoice_nota; ?>" readonly>
            </div>

            <!-- Form untuk memasukkan barang -->
            <h2>Input Barang</h2>
            <?php
            for ($i = 1; $i <= $jumlah_pesanan; $i++) {
            ?>
            <div class="form-group">
                <label for="nama_barang_<?php echo $i; ?>">Nama Barang <?php echo $i; ?>:</label>
                <input type="text" class="form-control" id="nama_barang_<?php echo $i; ?>" name="nama_barang_<?php echo $i; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_barang_<?php echo $i; ?>">Harga Barang <?php echo $i; ?>:</label>
                <input type="number" class="form-control" id="harga_barang_<?php echo $i; ?>" name="harga_barang_<?php echo $i; ?>" required>
            </div>
            <!-- Tambahkan form input lainnya sesuai dengan kebutuhan -->
            <?php
            }
            ?>
            <!-- Form untuk memasukkan barang -->

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    </body>
</html>
