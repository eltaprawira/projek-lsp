<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM kandidat");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lihat Kandidat</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
    .kandidat { display: flex; flex-wrap: wrap; gap: 20px; }
    .kartu { background: white; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 15px; width: 250px; text-align: center; }
    .kartu img { width: 100%; height: 200px; object-fit: cover; border-radius: 5px; }
    .nama { font-size: 18px; margin-top: 10px; font-weight: bold; }
    .visi, .misi { font-size: 14px; color: #333; margin-top: 5px; }
  </style>
</head>
<body>

<h2>Daftar Calon Kandidat</h2>
<div class="kandidat">
  <?php while ($data = mysqli_fetch_array($query)) : ?>
    <div class="kartu">
      <img src="foto_kandidat/<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>">
      <div class="nama"><?= $data['nama'] ?></div>
      <div class="visi"><strong>Visi:</strong> <?= $data['visi'] ?></div>
      <div class="misi"><strong>Misi:</strong> <?= $data['misi'] ?></div>
    </div>
  <?php endwhile; ?>
</div>

</body>
</html>