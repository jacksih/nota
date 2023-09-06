<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

        h1, h5 {
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
    <?php include 'nav.php'; ?>
    
    <div class="container mt-4">
        <div class="row">
            <?php include 'sidebar_admin.php'; ?>
            <div class="col-md-8">
                <h1 class="text-center">Daftar Pengguna</h1>
                <!-- Tampilkan daftar pengguna dari database di sini -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';

                        $sql = "SELECT * FROM users"; // Sesuaikan dengan nama tabel pengguna Anda
                        $result = mysqli_query($connection, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td><a href='detail_pengguna.php?id=" . $row["id"] . "' class='btn btn-primary'>Lihat Detail</a></td>";
                                echo "<td><a href='hapus_user.php?id=" . $row["id"] . "' class='btn btn-danger'>Hapus Pengguna</a></td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data pengguna.</td></tr>";
                        }

                        // Tutup koneksi ke database
                        mysqli_close($connection);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
