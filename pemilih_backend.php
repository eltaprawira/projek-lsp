<?php
$koneksi = new mysqli("localhost", "root", "root", "pemilihan_struktur_kelas");

// Handle request berdasarkan aksi
$action = $_POST['action'];

if ($action === 'load') {
  $result = $koneksi->query("SELECT * FROM data_pemilih");
  $rows = [];
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  echo json_encode($rows);
}

if ($action === 'save') {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $kelas = $_POST['kelas'];
  $status_memilih = $_POST['status_memilih'];
  $kode_akses = $_POST['kode_akses'];

  // Cek apakah NIS sudah ada
  $cek = $koneksi->query("SELECT * FROM data_pemilih WHERE nis = '$nis'");
  if ($cek->num_rows > 0) {
    // Update
    $koneksi->query("UPDATE data_pemilih SET nama='$nama', jurusan='$jurusan', kelas='$kelas', status_memilih='$status_memilih', kode_akses='$kode_akses' WHERE nis='$nis'");
  } else {
    // Insert
    $koneksi->query("INSERT INTO data_pemilih (nis, nama, jurusan, kelas, status_memilih, kode_akses) VALUES ('$nis', '$nama', '$jurusan', '$kelas', '$status_memilih', '$kode_akses')");
  }

  echo "success";
}

if ($action === 'delete') {
  $nis = $_POST['nis'];
  $koneksi->query("DELETE FROM data_pemilih WHERE nis = '$nis'");
  echo "deleted";
}
?>