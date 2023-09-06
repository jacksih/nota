<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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

        h2 {
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

    <div class="container">
        <h2>Daftar Barang</h2>
        <div class="mt-3">
            <a href="buat_nota.php" class="btn btn-success">Buat Nota</a>
            <a href="daftar_nota.php" class="btn btn-info">Daftar Nota</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                // Query untuk mengambil data barang dari database
                $sql = "SELECT * FROM barang"; // Sesuaikan dengan nama tabel Anda
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["nama_barang"] . "</td>";
                        echo "<td>Rp " . number_format($row["harga"], 0, ",", ".") . "</td>";
                        echo "<td><button class='btn btn-primary'>Beli</button></td>";
                        echo "</tr>";
                    }
                    mysqli_free_result($result);
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data barang.</td></tr>";
                }

                // Tutup koneksi ke database
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
