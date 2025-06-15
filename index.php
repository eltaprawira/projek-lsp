<?php
//jika belum login redirect ke halaman login
session_start();
$email = $_SESSION['email'];
if(!isset($email)){
  header('Location:login.php');
}

?>
<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "root", "pemilihan_struktur_kelas");

// Hitung jumlah total pemilih
$jumlahPemilih = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM data_pemilih"));

// Hitung jumlah yang sudah memilih (status_memilih != 'belum')
$jumlahSudahMemilih = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM data_pemilih WHERE status_memilih != 'belum'"));

// Hitung jumlah yang belum memilih
$jumlahBelumMemilih = $jumlahPemilih - $jumlahSudahMemilih;

// Hitung jumlah kandidat
$jumlahKandidat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kandidat"));

// Hitung persentase untuk progress bar
$persenMemilih = $jumlahPemilih > 0 ? round(($jumlahSudahMemilih / $jumlahPemilih) * 100) : 0;
$persenBelum = 100 - $persenMemilih;
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
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
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
       

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        
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
            <a href="logout.php" class="nav-link active">
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
              <ul class="n  av nav-treeview">
                <li class="nav-item">
                  <a href="index2.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kelas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="datapemilih.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pemilih</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index3.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kandidat</p>
                  </a>
                </li>
              </ul>
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

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0">Dashboard </h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                    </div>
                </div>
                </div>
            </div>
                        <!-- /.content-header -->
            <!-- Bagian utama -->
            <div class="container-fluid px-4">
            <!-- Baris info-box -->
            <div class="row">
                <!-- Jumlah Pemilih -->
                <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pemilih</span>
                    <span class="info-box-number"><?= $jumlahPemilih ?></span>
                    </div>
                </div>
                </div>

                <!-- Sudah Memilih -->
                <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Yang Sudah Memilih</span>
                    <span class="info-box-number"><?= $jumlahSudahMemilih ?></span>
                    </div>
                </div>
                </div>

                <!-- Jumlah Kandidat -->
                <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-graduate"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Jumlah Kandidat</span>
                    <span class="info-box-number"><?= $jumlahKandidat ?></span>
                    </div>
                </div>
                </div>

                <!-- Belum Memilih -->
                <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-times"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Yang Belum Memilih</span>
                    <span class="info-box-number"><?= $jumlahBelumMemilih ?></span>
                    </div>
                </div>
                </div>
            </div>

            <!-- CARD GOAL COMPLETION -->
            <div class="card mb-4">
                <div class="card-header">
                <h3 class="card-title text-center w-100"><strong>Goal Completion</strong></h3>
                </div>
                <div class="card-body">
                <div class="progress-group mb-4">
                    Sudah Memilih
                    <span class="float-right"><b><?= $jumlahSudahMemilih ?></b>/<?= $jumlahPemilih ?></span>
                    <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: <?= $persenMemilih ?>%"></div>
                    </div>
                </div>

                <div class="progress-group mb-4">
                    Belum Memilih
                    <span class="float-right"><b><?= $jumlahBelumMemilih ?></b>/<?= $jumlahPemilih ?></span>
                    <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: <?= $persenBelum ?>%"></div>
                    </div>
                </div>

                <div class="progress-group mb-4">
                    Jumlah Kandidat Terdaftar
                    <span class="float-right"><b><?= $jumlahKandidat ?></b></span>
                    <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 100%"></div>
                    </div>
                </div>
                </div>
            </div>
            </div>

            </div>
            </div>
            
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
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