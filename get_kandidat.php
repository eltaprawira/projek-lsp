<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM kandidat WHERE id = $id");
$data = mysqli_fetch_assoc($query);
echo json_encode($data);
?>