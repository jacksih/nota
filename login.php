<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        /* Tambahkan gaya CSS ini untuk latar belakang */
        body {
            background-image: linear-gradient(120deg, #0f0122 0%, #1c1b3a 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff; /* Ganti warna teks menjadi putih */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2); /* Tambahkan lapisan transparan pada kontainer */
            border-radius: 10px; /* Tambahkan sudut bulat pada kontainer */
            padding: 20px; /* Tambahkan padding */
        }

        /* Ganti warna teks pada card header menjadi putih */
        .card-header {
            background-color: transparent;
            border-bottom: none;
            text-align: center;
            color: #fff;
        }

        /* Ganti warna teks pada formulir menjadi putih */
        .form-label,
        .btn {
            color: #fff;
        }

        /* Ganti warna latar belakang formulir */
        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Ganti warna border input saat di-focus */
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            border-color: #fff;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="">
                    <div class="">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="">
                        <form method="post" action="proces_login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <input type="submit" name="submit" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</body>

</html>
