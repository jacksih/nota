<!-- logout.php -->
<?php
// Mulai sesi
session_start();

// Hapus semua data sesi (logout pengguna)
session_unset();
session_destroy();

// Redirect kembali ke halaman home (misalnya index.php)
header("Location: index.php");
exit();
?>
