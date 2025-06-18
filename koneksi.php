<?php
$host = "localhost";     
$user = "root";           
$pass = "root";               
$db   = "pemilihan_struktur_kelas";        

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
