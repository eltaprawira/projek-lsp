<?php
$koneksi = new mysqli("localhost", "root", "root", "pemilihan_struktur_kelas");

// Ambil semua data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $result = $koneksi->query("SELECT * FROM kelas_jurusan ORDER BY id DESC");
  $data = [];
  while ($row = $result->fetch_assoc()) {
    $row['suara'] = explode("\n", $row['suara']);
    $data[] = $row;
  }
  echo json_encode($data);
  exit;
}

// Tambah atau update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id     = $_POST['id'] ?? '';
  $jurusan = $_POST['jurusan'];
  $kelas   = $_POST['kelas'];
  $siswa   = $_POST['siswa'];
  $suara   = $_POST['suara'];

  if ($id) {
    // update
    $stmt = $koneksi->prepare("UPDATE kelas_jurusan SET jurusan=?, kelas=?, siswa=?, suara=? WHERE id=?");
    $stmt->bind_param("ssisi", $jurusan, $kelas, $siswa, $suara, $id);
  } else {
    // insert
    $stmt = $koneksi->prepare("INSERT INTO kelas_jurusan (jurusan, kelas, siswa, suara) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $jurusan, $kelas, $siswa, $suara);
  }

  $stmt->execute();
  echo json_encode(["status" => "ok"]);
  exit;
}

// Hapus data
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents("php://input"), $_DELETE);
  $id = $_DELETE['id'] ?? 0;
  $koneksi->query("DELETE FROM kelas_jurusan WHERE id=$id");
  echo json_encode(["status" => "deleted"]);
  exit;
}
?>