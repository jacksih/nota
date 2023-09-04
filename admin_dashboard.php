<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- CSS dan lainnya di sini -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

    <?php include 'nav.php'; ?>
    
    <div class="container mt-4 row">
      <?php include 'sidebar_admin.php'; ?>
      <div class="col-md-8">
        <h1>Daftar Pengguna</h1>
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
                        echo "<td><a href='hapus_user.php?id=" . $row["id"] . "' class='btn btn-primary'>Hapus Pengguna</a></td>";
                        echo "</tr>";
                    }
                    mysqli_free_result($result);
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data pengguna.</td></tr>";
                }

                // Tutup koneksi ke database
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
