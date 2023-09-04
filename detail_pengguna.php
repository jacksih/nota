<!-- detail_pengguna.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengguna</title>
    <!-- CSS dan lainnya di sini -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<?php include 'nav.php'; ?>
    
    <div class="container mt-4 row">
      <?php include 'sidebar_admin.php'; ?>
      <div class="col-md-8">
      <div class="container mt-4">
        <h1>Detail Pengguna</h1>
        <?php
        // Koneksi ke database
        include 'koneksi.php';

        // Dapatkan ID pengguna dari URL
        $user_id = $_GET['id'];

        // Query untuk mendapatkan data pengguna berdasarkan ID
        $query = "SELECT * FROM users WHERE id='$user_id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $nama = $row['nama'];
                $email = $row['email'];
                $username = $row['username'];

                // Tampilkan informasi pengguna
                echo "<p><strong>Nama:</strong> $nama</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Username:</strong> $username</p>";
            } else {
                echo "Pengguna tidak ditemukan.";
            }
        } else {
            echo "Terjadi kesalahan dalam mengambil data pengguna.";
        }

        // Tutup koneksi ke database
        mysqli_close($connection);
        ?>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

    <script>
        // Fungsi untuk mengonfirmasi penghapusan pengguna
        document.getElementById("hapus_pengguna").addEventListener("click", function() {
            if (confirm("Anda yakin ingin menghapus pengguna ini?")) {
                // Jika pengguna mengonfirmasi, redirect atau lakukan tindakan penghapusan sesuai kebutuhan
            }
        });
    </script>
</body>
</html>
