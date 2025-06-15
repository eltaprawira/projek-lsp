<?php
include 'koneksi.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
  $nama = $_POST['nama'];
  $keterangan = $_POST['keterangan'];
  $fotoName = $_FILES['foto']['name'];
  $fotoTmp = $_FILES['foto']['tmp_name'];
  $namaBaru = time() . '_' . basename($fotoName);
  move_uploaded_file($fotoTmp, 'uploads/' . $namaBaru);

  mysqli_query($koneksi, "INSERT INTO kandidat (nama, keterangan, foto) VALUES ('$nama', '$keterangan', '$namaBaru')");
  echo "sukses";
}

if ($aksi == 'edit') {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $keterangan = $_POST['keterangan'];
  $fotoLama = $_POST['oldFoto'];

  if ($_FILES['foto']['name']) {
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $namaBaru = time() . '_' . basename($fotoName);
    move_uploaded_file($fotoTmp, 'uploads/' . $namaBaru);
    unlink('uploads/' . $fotoLama);
  } else {
    $namaBaru = $fotoLama;
  }

  mysqli_query($koneksi, "UPDATE kandidat SET nama='$nama', keterangan='$keterangan', foto='$namaBaru' WHERE id=$id");
  echo "sukses";
}

if ($aksi == 'hapus') {
  $id = $_GET['id'];
  $get = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM kandidat WHERE id=$id"));
  unlink('uploads/' . $get['foto']);
  mysqli_query($koneksi, "DELETE FROM kandidat WHERE id=$id");
  echo "sukses";
}
?>