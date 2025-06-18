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
  <title></title>

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

    <!-- Tabel Data Kelas/Jurusan -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Data Kelas/Jurusan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Kelas/Jurusan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah/Edit -->
  <div id="modalForm" style="display:none; position:fixed; top:20%; left:50%; transform:translateX(-50%); background:white; padding:20px; box-shadow:0 0 10px gray; z-index:999; width:300px;">
    <h5 id="formTitle">Tambah/Edit Kelas</h5>
    <input id="jurusanInput" class="form-control mb-2" placeholder="Jurusan"><br>
    <input id="kelasInput" class="form-control mb-2" placeholder="Kelas"><br>
    <input id="siswaInput" class="form-control mb-2" placeholder="Jumlah siswa"><br>
    <textarea id="suaraInput" class="form-control mb-2" placeholder="Kandidat 1: 10&#10;Kandidat 2: 5"></textarea><br>
    <button class="btn btn-success btn-sm" onclick="saveForm()">Simpan</button>
    <button class="btn btn-secondary btn-sm" onclick="hideFormModal()">Batal</button>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div id="modalDelete" style="display:none; position:fixed; top:30%; left:50%; transform:translateX(-50%); background:white; padding:20px; box-shadow:0 0 10px gray; z-index:999; width:280px;">
    <p>Yakin ingin menghapus data ini?</p>
    <button class="btn btn-danger btn-sm" onclick="deleteConfirmed()">Ya, Hapus</button>
    <button class="btn btn-secondary btn-sm" onclick="hideDeleteModal()">Batal</button>
  </div>

  <!-- Tabel -->
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header clearfix">
          <h3 class="card-title" style="float:left;">Data Kelas</h3>
          <button class="btn btn-success btn-sm" style="float:right;" onclick="showFormModal()">+ Tambah</button>
        </div>
        <div class="card-body">
          <table id="example100" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th><th>Jurusan</th><th>Kelas</th><th>Siswa</th><th>Suara</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tableBody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script>
  let editingId = null;
  let deletingId = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadTable();
  });

  function loadTable() {
    fetch("kelas_backend.php")
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        data.forEach((item, index) => {
          const suaraText = (item.suara || []).join('<br>');
          tbody.innerHTML += `
            <tr>
              <td>${index + 1}</td>
              <td>${item.jurusan}</td>
              <td>${item.kelas}</td>
              <td>${item.siswa}</td>
              <td>${suaraText}</td>
              <td>
                <button class="btn btn-sm btn-primary" onclick="editRow(${item.id})">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="confirmDelete(${item.id})">Hapus</button>
              </td>
            </tr>
          `;
        });

        // Inisialisasi DataTables ulang
        $('#example100').DataTable({
          destroy: true,
          responsive: true,
          lengthChange: false,
          autoWidth: false
        });
      });
  }

  function showFormModal() {
    editingId = null;
    document.getElementById('formTitle').innerText = "Tambah Kelas";
    document.getElementById('jurusanInput').value = '';
    document.getElementById('kelasInput').value = '';
    document.getElementById('siswaInput').value = '';
    document.getElementById('suaraInput').value = '';
    document.getElementById('modalForm').style.display = 'block';
  }

  function hideFormModal() {
    document.getElementById('modalForm').style.display = 'none';
  }

  function saveForm() {
    const jurusan = document.getElementById('jurusanInput').value.trim();
    const kelas = document.getElementById('kelasInput').value.trim();
    const siswa = document.getElementById('siswaInput').value.trim();
    const suaraRaw = document.getElementById('suaraInput').value.trim();
    const suara = suaraRaw.split('\n').map(s => s.trim()).filter(Boolean).join('\n');

    if (!jurusan || !kelas || !siswa) {
      alert("Semua field harus diisi!");
      return;
    }

    const formData = new FormData();
    if (editingId !== null) formData.append("id", editingId);
    formData.append("jurusan", jurusan);
    formData.append("kelas", kelas);
    formData.append("siswa", siswa);
    formData.append("suara", suara);

    fetch("kelas_backend.php", {
      method: "POST",
      body: formData
    }).then(() => {
      loadTable();
      hideFormModal();
    });
  }

  function editRow(id) {
    fetch("kelas_backend.php")
      .then(res => res.json())
      .then(data => {
        const item = data.find(d => d.id == id);
        editingId = id;
        document.getElementById('jurusanInput').value = item.jurusan;
        document.getElementById('kelasInput').value = item.kelas;
        document.getElementById('siswaInput').value = item.siswa;
        document.getElementById('suaraInput').value = (item.suara || []).join('\n');
        document.getElementById('formTitle').innerText = "Edit Kelas";
        document.getElementById('modalForm').style.display = 'block';
      });
  }

  function confirmDelete(id) {
    deletingId = id;
    document.getElementById('modalDelete').style.display = 'block';
  }

  function hideDeleteModal() {
    deletingId = null;
    document.getElementById('modalDelete').style.display = 'none';
  }

  function deleteConfirmed() {
    if (deletingId !== null) {
      fetch("kelas_backend.php", {
        method: "DELETE",
        body: new URLSearchParams({ id: deletingId })
      }).then(() => {
        loadTable();
        hideDeleteModal();
      });
    }
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