<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
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
        .transaksi-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .transaksi-heading {
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .transaksi-form {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .transaksi-form label {
            font-weight: bold;
        }
        .transaksi-form input {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4 transaksi-container">
        <h1 class="transaksi-heading">Form Transaksi</h1>
        <?php
        session_start();

        // Tampilkan data nota yang telah diinput sebelumnya
        if (isset($_SESSION["tanggal"]) && isset($_SESSION["invoice"]) && isset($_SESSION["namaPenerima"])) {
            echo "<div class='transaksi-form'>";
            echo "<h2 class='transaksi-heading'>Nota:</h2>";
            echo "<p><strong>Tanggal:</strong> " . $_SESSION["tanggal"] . "</p>";
            echo "<p><strong>Invoice:</strong> " . $_SESSION["invoice"] . "</p>";
            echo "<p><strong>Penerima:</strong> " . $_SESSION["namaPenerima"] . "</p>";
            echo "</div>";
        }

        // Tampilkan form transaksi
        if (isset($_SESSION["jumlahPesanan"]) && $_SESSION["jumlahPesanan"] > 0) {
            $jumlahPesanan = $_SESSION["jumlahPesanan"];
            echo "<form method='post' action='simpan_transaksi.php'>";
            for ($i = 1; $i <= $jumlahPesanan; $i++) {
                echo "<div class='transaksi-form'>";
                echo "<h2 class='transaksi-heading'>Transaksi $i:</h2>";
                echo "<label for='no$i'>No:</label>";
                echo "<input type='text' id='no$i' name='no[]' required>";
                echo "<label for='deskripsi$i'>Deskripsi:</label>";
                echo "<input type='text' id='deskripsi$i' name='deskripsi[]' required>";
                echo "<label for='jumlah$i'>Jumlah:</label>";
                echo "<input type='number' id='jumlah$i' name='jumlah[]' required>";
                echo "<label for='harga$i'>Harga:</label>";
                echo "<input type='number' id='harga$i' name='harga[]' required>";
                echo "</div>";
            }
            echo "<br>";
            echo "<div class='text-center'>";
            echo "<input type='submit' value='Simpan Transaksi' class='btn btn-primary'>";
            echo "</div>";
            echo "</form>";
        } else {
            echo "<p class='text-center'>Jumlah pesanan tidak valid.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
