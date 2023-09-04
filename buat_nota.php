<!DOCTYPE html>
<html>
<head>
    <title>Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .form-label {
            font-weight: bold;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .form-submit-btn {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'navbar_user.php'; ?>

    <div class="container mt-4 form-container">
        <h1 class="text-center">Form Nota</h1>
        <form id="notaForm" method="post" action="simpan_nota.php">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label" for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <?php
                    // Skrip PHP untuk mengisi invoice_nota sesuai format "N000001"
                    include 'koneksi.php';

                    // Mengambil nilai id terakhir dari tabel
                    $query = "SELECT id FROM nota ORDER BY id DESC LIMIT 1";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    $next_id = $row['id'] + 1;
                    $invoice = 'N' . str_pad($next_id, 6, '0', STR_PAD_LEFT);
                    ?>

                    <div class="mb-3">
                        <label class="form-label" for="invoice">Invoice:</label>
                        <input type="text" class="form-control" id="invoice" name="invoice" required value="<?php echo $invoice; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="pengirim">Pengirim:</label>
                        <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="namaPenerima">Nama Penerima:</label>
                        <input type="text" class="form-control" id="namaPenerima" name="namaPenerima" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label" for="desa">Desa:</label>
                        <input type="text" class="form-control" id="desa" name="desa" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kecamatan">Kecamatan:</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="alamatPenerima">Alamat Penerima:</label>
                        <input type="text" class="form-control" id="alamatPenerima" name="alamatPenerima" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="noHp">No. HP:</label>
                        <input type="tel" class="form-control" id="noHp" name="noHp" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="jumlahPesanan">Jumlah Pesanan:</label>
                <input type="number" class="form-control" id="jumlahPesanan" name="jumlahPesanan" required>
            </div>

            <div class="form-submit-btn">
                <input type="submit" value="Lanjutkan" onclick="return validateForm()" class="btn btn-primary">
            </div>
        </form>
    </div>

    <script>
        function formatDate(dateString) {
            const [year, month, day] = dateString.split("-");
            return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
        }

        function validateForm() {
            var jumlahPesanan = document.getElementById("jumlahPesanan").value;
            if (jumlahPesanan <= 0) {
                alert("Jumlah pesanan harus lebih dari 0.");
                return false;
            }

            // Konversi tanggal ke format yang sesuai sebelum mengirim data
            var tanggalInput = document.getElementById("tanggal").value;
            document.getElementById("tanggal").value = formatDate(tanggalInput);

            // Submit form secara otomatis setelah validasi berhasil
            document.getElementById("notaForm").submit();
            return true;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
