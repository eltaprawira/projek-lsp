<?php
$koneksi = new mysqli("localhost", "root", "root", "pemilihan_struktur_kelas");

$action = $_POST['action'];

if ($action === 'load') {
  $result = $koneksi->query("SELECT * FROM data_pemilih WHERE LOWER(status_memilih) = 'belum memilih'");
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
  $original_nis = $_POST['original_nis'];

  if ($original_nis && $original_nis != $nis) {
    // Cek kalau ganti NIS, pastikan yang baru belum dipakai
    $cek = $koneksi->query("SELECT * FROM data_pemilih WHERE nis = '$nis'");
    if ($cek->num_rows > 0) {
      echo "error: NIS sudah digunakan";
      exit;
    }
  }

  if ($original_nis) {
    // Update (edit)
    $koneksi->query("UPDATE data_pemilih SET nis='$nis', nama='$nama', jurusan='$jurusan', kelas='$kelas', status_memilih='$status_memilih', kode_akses='$kode_akses' WHERE nis='$original_nis'");
  } else {
    // Tambah baru
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