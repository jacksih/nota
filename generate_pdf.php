<?php
if (isset($_POST["nota_id"])) {
    $nota_id = $_POST["nota_id"];

    // Koneksi ke database (ganti sesuai dengan informasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nota";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data atau menghasilkan tampilan HTML sesuai dengan data nota_id
    $sql_nota = "SELECT * FROM nota WHERE id = $nota_id";
    $result_nota = $conn->query($sql_nota);

    if ($result_nota->num_rows > 0) {
        $row_nota = $result_nota->fetch_assoc();

        // Ambil data transaksi terkait dengan nota dari database
        $sql_transaksi = "SELECT * FROM transaksi WHERE nota_id = $nota_id";
        $result_transaksi = $conn->query($sql_transaksi);

        // Buat tampilan HTML sesuai dengan data nota dan transaksi
        $html = "
        <html>
        <head>
            <title>Detail Nota</title>
        </head>
        <body>
            <div class='container mt-4'>
                <div class='header'>
                    <img src='./Assets/logodj.png' alt='' style=' height: 6rem; width:9rem'>
                    <h5>PT. DIGITAL DARMAJAYA DIGITAL SOLUSI</h5>
                    <h6 class='mb-3'>BUKTI PEMBAYARAN</h6>
                </div>
                
                <div class='row'>
                    <div class='col-md-6'>
                        <p>Tanggal Nota: " . $row_nota["tanggal"] . "</p>
                        <p>Invoice: " . $row_nota["invoice"] . "</p>
                        <p>Penanggung Jawab: " . $row_nota["pengirim"] . "</p>
                        <p>Nama Penerima: " . $row_nota["namaPenerima"] . "</p>
                    </div>
                    <div class='col-md-6'>
                        <p>Desa: " . $row_nota["desa"] . "</p>
                        <p>Kecamatan: " . $row_nota["kecamatan"] . "</p>
                        <p>Alamat Penerima: " . $row_nota["alamatPenerima"] . "</p>
                        <p>Telepon Penerima: " . $row_nota["noHp"] . "</p>
                    </div>
                </div>

                <!-- Tambahkan kode untuk menampilkan daftar transaksi sesuai dengan data nota_id -->
                <div class='table-responsive mt-4'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Loop untuk menambahkan data transaksi ke tampilan HTML
        if ($result_transaksi->num_rows > 0) {
            $no = 1;
            while ($row_transaksi = $result_transaksi->fetch_assoc()) {
                $html .= "
                            <tr>
                                <td>" . $no . "</td>
                                <td>" . $row_transaksi["deskripsi"] . "</td>
                                <td>" . $row_transaksi["jumlah"] . "</td>
                                <td>" . $row_transaksi["harga"] . "</td>
                            </tr>";
                $no++;
            }
        }

        $html .= "</tbody>
                    </table>
                </div>
                
                <!-- Informasi Kontak dan Tanda Tangan Direktur -->
                <div class='contact-info-signature d-flex justify-content-between'>
                    <div class='contact-info'>
                        <p class='fw-bold'>If you have any questions about this invoice, please contact:</p>
                        <p class='fw-bold'>[ PT . D a r m a j a y a D i g i t a l S o l u s i ]</p>
                        <p class='fw-bold'>[ J l . Z A . P a g a r A l a m N o . 9 3 , G e d o n g M e n e n g ]</p>
                        <p class='fw-bold'>[ K e c . R a j a b a s a , K o t a B a n d a r L a m p u n g , L a m p u n g 3 5 1 4 1 ]</p>
                        <p class='fw-bold'>Phone [ 0 8 1 3 - 7 7 0 0 - 1 0 0 8 ]</p>
                        <p class='fw-bold'>Fax [ 0 8 1 3 - 7 7 0 0 - 1 0 0 8 ]</p>
                        <p class='fw-bold'>Email [ darmajayacorp@gmail.com ]</p>
                    </div>
                    <div class='signature'>
                        <p>Hormat kami</p>
                        <br>
                        <br>
                        <br>
                        <p>Direktur :</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";

        $conn->close();
    } else {
        echo "<p>Nota tidak ditemukan.</p>";
        exit;
    }

    // Generate PDF
    require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan dengan path ke autoload.php mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    // Simpan PDF ke file atau tampilkan dalam browser
    $pdfFileName = 'Nota-' . $nota_id . '.pdf'; // Nama file PDF
    $mpdf->Output($pdfFileName, 'D'); // Tampilkan dalam browser dengan 'D' atau simpan dengan 'F'
    exit;
}
?>
