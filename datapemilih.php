<?php
//jika belum login redirect ke halaman login
session_start();
$email = $_SESSION['email'];
if(!isset($email)){
  header('Location:login.php');
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


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
        <ul>

      
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
                    <p>Data Pemilihan</p>
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
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pemilih</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pemilih</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Form -->
   
  <div id="modalForm" style="display:none; position:fixed; top:20%; left:50%; transform:translateX(-50%); background:white; padding:20px; box-shadow:0 0 10px gray; z-index:999; width:300px;">
    <h5 id="formTitle">Tambah/Edit Pemilih</h5>
    <input type="text" id="nisInput" class="form-control mb-2" placeholder="NIS" oninput="generateKodeAkses()">
    <input type="text" id="namaInput" class="form-control mb-2" placeholder="Nama Lengkap" oninput="generateKodeAkses()">
    <input type="text" id="jurusanInput" class="form-control mb-2" placeholder="Jurusan" oninput="generateKodeAkses()">
    <input type="text" id="kelasInput" class="form-control mb-2" placeholder="Kelas" oninput="generateKodeAkses()">
    <select id="statusMemilihInput" class="form-control mb-2">
      <option value="Belum Memilih">Belum Memilih</option>
      <option value="Sudah Memilih">Sudah Memilih</option>
    </select>
    <input type="text" id="kodeAksesInput" class="form-control mb-2" placeholder="Kode Akses (Otomatis)" readonly>
    <button class="btn btn-success btn-sm" onclick="saveForm()">Simpan</button>
    <button class="btn btn-secondary btn-sm" onclick="hideFormModal()">Batal</button>
  </div>

  <!-- Modal Hapus -->
  <div id="modalDelete" style="display:none; position:fixed; top:30%; left:50%; transform:translateX(-50%); background:white; padding:20px; box-shadow:0 0 10px gray; z-index:999; width:280px;">
    <p>Yakin ingin menghapus data ini?</p>
    <button class="btn btn-danger btn-sm" onclick="deleteConfirmed()">Ya, Hapus</button>
    <button class="btn btn-secondary btn-sm" onclick="hideDeleteModal()">Batal</button>
  </div>

  <!-- Konten Tabel -->
<div class="content">
  <div class="container-fluid"> 
    <div class="card">
      <div class="card-header clearfix">
        <h3 class="card-title" style="float:left;">Data Pemilih</h3>
        <button class="btn btn-success btn-sm" style="float:right;" onclick="showFormModal()">+ Tambah</button>
      </div>
      <div class="card-body">
        <table id="example100" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th><th>NIS</th><th>Nama Lengkap</th><th>Jurusan</th><th>Kelas</th><th>Status Memilih</th><th>Kode Akses</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
let editingIndex = null;
let deletingIndex = null;
let dataTable;

document.addEventListener('DOMContentLoaded', () => {
  refreshTable();
});

function getStoredData() {
  return JSON.parse(localStorage.getItem("pemilihData")) || [];
}

function saveToStorage(data) {
  localStorage.setItem("pemilihData", JSON.stringify(data));
}

function generateKodeAkses() {
  const nis = document.getElementById('nisInput').value.trim();
  const nama = document.getElementById('namaInput').value.trim();
  const jurusan = document.getElementById('jurusanInput').value.trim();
  const kelas = document.getElementById('kelasInput').value.trim();
  if (nis && nama && jurusan && kelas) {
    const kode = btoa(nis + nama + jurusan + kelas).slice(0, 8);
    document.getElementById('kodeAksesInput').value = kode;
  }
}

function showFormModal(index = null) {
  document.getElementById('modalForm').style.display = 'block';
  editingIndex = index;

  if (index !== null) {
    const data = getStoredData()[index];
    document.getElementById('nisInput').value = data.nis;
    document.getElementById('namaInput').value = data.nama;
    document.getElementById('jurusanInput').value = data.jurusan;
    document.getElementById('kelasInput').value = data.kelas;
    document.getElementById('statusMemilihInput').value = data.status_memilih;
    document.getElementById('kodeAksesInput').value = data.kode_akses;
  } else {
    document.getElementById('nisInput').value = '';
    document.getElementById('namaInput').value = '';
    document.getElementById('jurusanInput').value = '';
    document.getElementById('kelasInput').value = '';
    document.getElementById('statusMemilihInput').value = 'Belum Memilih';
    document.getElementById('kodeAksesInput').value = '';
  }
}

function hideFormModal() {
  document.getElementById('modalForm').style.display = 'none';
}

function saveForm() {
  const nis = document.getElementById('nisInput').value.trim();
  const nama = document.getElementById('namaInput').value.trim();
  const jurusan = document.getElementById('jurusanInput').value.trim();
  const kelas = document.getElementById('kelasInput').value.trim();
  const status_memilih = document.getElementById('statusMemilihInput').value.trim();
  const kode_akses = document.getElementById('kodeAksesInput').value.trim();

  if (!nis || !nama || !jurusan || !kelas || !status_memilih || !kode_akses) {
    alert("Semua field harus diisi!");
    return;
  }

  const data = new URLSearchParams();
  data.append("action", "save");
  data.append("nis", nis);
  data.append("nama", nama);
  data.append("jurusan", jurusan);
  data.append("kelas", kelas);
  data.append("status_memilih", status_memilih);
  data.append("kode_akses", kode_akses);

  fetch('pemilih_backend.php', {
    method: 'POST',
    body: data
  }).then(res => res.text())
    .then(() => {
      refreshTable();
      hideFormModal();
    });
}


function loadTable() {
  fetch('pemilih_backend.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=load'
  })
  .then(res => res.json())
  .then(data => {
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    data.forEach((item, index) => {
      tbody.innerHTML += `
        <tr>
          <td>${index + 1}</td>
          <td>${item.nis}</td>
          <td>${item.nama}</td>
          <td>${item.jurusan}</td>
          <td>${item.kelas}</td>
          <td>${item.status_memilih}</td>
          <td>${item.kode_akses}</td>
          <td class="d-flex gap-1">
            <button class="btn btn-sm btn-primary" onclick="editRow(${index})">Edit</button>
            <button class="btn btn-sm btn-danger" onclick="confirmDelete('${item.nis}')">Hapus</button>
          </td>
        </tr>
      `;
    });
    window.serverData = data; // untuk dipakai di editRow()
  });
}
function editRow(index) {
  const data = window.serverData[index];
  showFormModal();
  document.getElementById('nisInput').value = data.nis;
  document.getElementById('namaInput').value = data.nama;
  document.getElementById('jurusanInput').value = data.jurusan;
  document.getElementById('kelasInput').value = data.kelas;
  document.getElementById('statusMemilihInput').value = data.status_memilih;
  document.getElementById('kodeAksesInput').value = data.kode_akses;
  editingIndex = index;
}

function confirmDelete(nis) {
  deletingIndex = nis;
  document.getElementById('modalDelete').style.display = 'block';
}

function hideDeleteModal() {
  deletingIndex = null;
  document.getElementById('modalDelete').style.display = 'none';
}

function deleteConfirmed() {
  if (deletingIndex !== null) {
    const data = new URLSearchParams();
    data.append("action", "delete");
    data.append("nis", deletingIndex);

    fetch('pemilih_backend.php', {
      method: 'POST',
      body: data
    }).then(res => res.text())
      .then(() => {
        refreshTable();
        hideDeleteModal();
      });
  }
}

function refreshTable() {
  fetch('pemilih_backend.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=load'
  })
  .then(res => res.json())
  .then(data => {
    if ($.fn.DataTable.isDataTable('#example100')) {
      $('#example100').DataTable().destroy();
    }

    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    data.forEach((item, index) => {
      tbody.innerHTML += `
        <tr>
          <td>${index + 1}</td>
          <td>${item.nis}</td>
          <td>${item.nama}</td>
          <td>${item.jurusan}</td>
          <td>${item.kelas}</td>
          <td>${item.status_memilih}</td>
          <td>${item.kode_akses}</td>
          <td class="d-flex gap-1">
            <button class="btn btn-sm btn-primary" onclick="editRow(${index})">Edit</button>
            <button class="btn btn-sm btn-danger" onclick="confirmDelete('${item.nis}')">Hapus</button>
          </td>
        </tr>
      `;
    });

    window.serverData = data;
    initDataTable(); // Baru inisialisasi setelah data selesai dimasukkan
  });
}
function initDataTable() {
  dataTable = $('#example100').DataTable({
    responsive: true,
    lengthChange: false, // ini dimatikan supaya "Show entries" tidak muncul
    autoWidth: false,
    searching: true
  });
}
</script>
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

  
</body>

</html>