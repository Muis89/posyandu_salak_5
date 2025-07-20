<?php
// Hindari notice jika session sudah aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['nama_admin']) || $_SESSION['nama_admin'] == '') {
    echo "<script>
            window.alert('Untuk mengakses, Anda harus Login terlebih dahulu!');
            window.location = 'index.php';
          </script>";
    exit(); // penting agar tidak lanjut eksekusi
}
?>