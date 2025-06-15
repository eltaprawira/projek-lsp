<?php
$host = "localhost";      // atau 127.0.0.1
$user = "root";           // default username MySQL
$pass = "root";               // biasanya kosong jika pakai XAMPP
$db   = "pemilihan_struktur_kelas";        // ganti dengan nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
