<?php
//jika belum login redirect ke halaman login
session_start();
$email = $_SESSION['email'];
if(!isset($email)){
  header('Location:login.php');
}

?>

<?php
include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM kandidat");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama']) && isset($_POST['keterangan'])) {
  $nama = $_POST['nama'];
  $keterangan = $_POST['keterangan'];

  // Proses upload foto
  $fotoName = $_FILES['foto']['name'];
  $fotoTmp = $_FILES['foto']['tmp_name'];

  if (!empty($fotoName)) {
    $folder = 'uploads/';
    $namaBaru = time() . '_' . basename($fotoName);
    $targetFile = $folder . $namaBaru;

    if (move_uploaded_file($fotoTmp, $targetFile)) {
      // Simpan ke database
      $query = "INSERT INTO kandidat (nama, keterangan, foto) VALUES ('$nama', '$keterangan', '$namaBaru')";
      mysqli_query($koneksi, $query);
      echo "<script>alert('Data berhasil disimpan!'); location.href='index3.php';</script>";
    } else {
      echo "<script>alert('Gagal upload foto.');</script>";
    }
  } else {
    echo "<script>alert('Foto belum dipilih.');</script>";
  }
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Kandidat</title>

  <!-- Google Font: Source Sans Pro -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="theme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $email ?></a>
          </div>
        </div>

         
        <!-- Dashboard Menu -->
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
            <li class="nav-item">
            <a href="index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
            </li>
        </ul>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Features
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index2.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kelas</p>
                  </a>
                </li>
                 
                <li class="nav-item">
                  <a href="datapemilih.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pemilih</p>
                  </a>
                </li>
               

                <li class="nav-item">
                  <a href="index3.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kandidat</p>
                  </a>
                </li>
                
              </ul>
            </li>

            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Logout Here
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Kandidat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Kandidat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

<!-- Konten Halaman -->
<div class="content">
  <div class="container-fluid">
    <div class="card mb-4">
      <div class="card-header clearfix">
        <h3 class="card-title" style="float: left;">Data Kandidat</h3>
        <button class="btn btn-success btn-sm float-end" onclick="showFormModal()">+ Tambah Kandidat</button>
      </div>

      <div class="card-body">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="cardContainer">
    <?php
    $no = 1;
    while ($d = mysqli_fetch_array($data)) :
      $kandidatKe = ($no % 2 == 1) ? 1 : 2;
    ?>
    <div class="col">
      <div class="card h-100 shadow-sm border-success">
        <img src="uploads/<?= htmlspecialchars($d['foto']) ?>" class="card-img-top" alt="Foto Kandidat" style="object-fit: cover; height: 250px;">
        <div class="card-body text-center">
          <h5 class="card-title text-success">Kandidat <?= $kandidatKe ?></h5><br>
          <p class="fw-bold mb-1">Nama:</p>
          <p><?= htmlspecialchars($d['nama']) ?></p>
          <p class="fw-bold mb-1">Keterangan:</p>
          <p><?= nl2br(htmlspecialchars($d['keterangan'])) ?></p>
        </div>
        <div class="card-footer d-flex justify-content-between">
          <button class="btn btn-warning btn-sm" onclick="showFormModal(<?= $d['id'] ?>)">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteItem(<?= $d['id'] ?>)">Hapus</button>
        </div>
      </div>
    </div>
    <?php $no++; endwhile; ?>
  </div>
</div>
    </div>
  </div>
</div>

<!-- Modal Form Tambah/Edit -->
<div id="modalForm" style="display:none; position: fixed; top: 20%; left: 50%; transform: translateX(-50%); background: white; padding: 20px; box-shadow: 0 0 10px gray; z-index: 999; width: 320px;">
  <h5 id="formTitle">Tambah Kandidat</h5>
  <form id="formKandidat" enctype="multipart/form-data">
    <input type="hidden" name="id" id="idEdit">
    <input type="hidden" name="oldFoto" id="fotoLama">
    <input type="text" name="nama" id="namaInput" class="form-control mb-2" placeholder="Nama Kandidat" required>
    <textarea name="keterangan" id="ketInput" class="form-control mb-2" placeholder="Keterangan Kandidat" required></textarea>
    <input type="file" name="foto" id="fotoInput" class="form-control mb-2">
    <div class="d-flex justify-content-between mt-2">
      <button type="button" class="btn btn-success btn-sm" onclick="saveForm()">Simpan</button>
      <button type="button" class="btn btn-secondary btn-sm" onclick="hideFormModal()">Batal</button>
    </div>
  </form>
</div>

<script>
function showFormModal(id = null) {
  const modal = document.getElementById('modalForm');
  document.getElementById('formTitle').innerText = id ? "Edit Kandidat" : "Tambah Kandidat";
  document.getElementById('formKandidat').reset();
  document.getElementById('fotoLama').value = '';
  document.getElementById('idEdit').value = '';

  if (id) {
    fetch('get_kandidat.php?id=' + id)
      .then(res => res.json())
      .then(data => {
        document.getElementById('namaInput').value = data.nama;
        document.getElementById('ketInput').value = data.keterangan;
        document.getElementById('fotoLama').value = data.foto;
        document.getElementById('idEdit').value = id;
      });
  }

  modal.style.display = 'block';
}

function hideFormModal() {
  document.getElementById('modalForm').style.display = 'none';
}

function saveForm() {
  const form = document.getElementById('formKandidat');
  const formData = new FormData(form);
  const id = formData.get('id');
  const endpoint = id ? 'kandidat_backend.php?aksi=edit' : 'kandidat_backend.php?aksi=tambah';

  fetch(endpoint, { method: 'POST', body: formData })
    .then(res => res.text())
    .then(() => location.reload());
}

function deleteItem(id) {
  if (confirm("Yakin ingin menghapus kandidat ini?")) {
    fetch('kandidat_backend.php?aksi=hapus&id=' + id)
      .then(() => location.reload());
  }
}
</script>
</body>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="theme/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="theme/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="theme/plugins/jszip/jszip.min.js"></script>
  <script src="theme/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="theme/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="theme/dist/js/adminlte.min.js"></script>

  <script>
    $(function () {
      $("#example100").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>