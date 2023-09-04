<!DOCTYPE html>
<html>
<head>
    <title>Detail Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
        }
        .signature {
            text-align: right;
            margin-top: 50px;
        }
        .contact-info {
            margin-top: 20px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Header -->
    <div class="header">
        <img src="./Assets/logodj.png" alt="" style=" height: 6rem; width:9rem">
        <h5>PT. DIGITAL DARMAJAYA DIGITAL SOLUSI</h5>
        <h6 class="mb-3">BUKTI PEMBAYARAN</h6>
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

        // Ambil ID nota dari parameter URL
        if (isset($_GET["id"])) {
            $nota_id = $_GET["id"];
        } else {
            echo "ID nota tidak ditemukan.";
            exit;
        }
        ?>
    </div>

    <?php
    // Ambil data nota dari database berdasarkan ID nota
    $sql_nota = "SELECT * FROM nota WHERE id = $nota_id";
    $result_nota = $conn->query($sql_nota);

    // Ambil data transaksi terkait dengan nota dari database
    $sql_transaksi = "SELECT * FROM transaksi WHERE nota_id = $nota_id";
    $result_transaksi = $conn->query($sql_transaksi);

    if ($result_nota->num_rows > 0) {
        $row_nota = $result_nota->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-md-6">
                <p>Tanggal Nota: <?= $row_nota["tanggal"] ?></p>
                <p>Invoice: <?= $row_nota["invoice"] ?></p>
                <p>Penanggung Jawab: <?= $row_nota["pengirim"] ?></p>
                <p>Nama Penerima: <?= $row_nota["namaPenerima"] ?></p>
            </div>
            <div class="col-md-6">
                <p>Desa: <?= $row_nota["desa"] ?></p>
                <p>Kecamatan: <?= $row_nota["kecamatan"] ?></p>
                <p>Alamat Penerima: <?= $row_nota["alamatPenerima"] ?></p>
                <p>Telepon Penerima: <?= $row_nota["noHp"] ?></p>
            </div>
        </div>

        <?php
        if ($result_transaksi->num_rows > 0) {
        ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_transaksi = $result_transaksi->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $row_transaksi["no"] ?></td>
                                <td><?= $row_transaksi["deskripsi"] ?></td>
                                <td><?= $row_transaksi["jumlah"] ?></td>
                                <td><?= $row_transaksi["harga"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo "<p>Tidak ada transaksi terkait.</p>";
        }
    } else {
        echo "<p>Nota tidak ditemukan.</p>";
    }

    $conn->close();
    ?>

    <!-- Informasi Kontak dan Tanda Tangan Direktur -->
    <div class="contact-info-signature d-flex justify-content-between">
        <div class="contact-info">
            <p class="fw-bold">If you have any questions about this invoice, please contact:</p>
            <p class="fw-bold">[ PT . D a r m a j a y a D i g i t a l S o l u s i ]</p>
            <p class="fw-bold">[ J l . Z A . P a g a r A l a m N o . 9 3 , G e d o n g M e n e n g ]</p>
            <p class="fw-bold">[ K e c . R a j a b a s a , K o t a B a n d a r L a m p u n g , L a m p u n g 3 5 1 4 1 ]</p>
            <p class="fw-bold">Phone [ 0 8 1 3 - 7 7 0 0 - 1 0 0 8 ]</p>
            <p class="fw-bold">Fax [ 0 8 1 3 - 7 7 0 0 - 1 0 0 8 ]</p>
            <p class="fw-bold">Email [ darmajayacorp@gmail.com ]</p>
        </div>
        <div class='signature'>
            <p>Hormat kami</p>
            <br>
            <br>
            <br>
            <p>Direktur :</p>
        </div>
    </div>

    <div class='button-container'>
        <form action='generate_pdf.php' method='post'>
            <input type='hidden' name='nota_id' value='<?= $nota_id; ?>'>
            <input type='submit' value='Unduh Nota PDF' class='btn btn-primary mt-3'>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
