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
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Starter Pages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index2.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kelas</p>
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Simple Link
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
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
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Kelas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header clearfix">
        <h3 class="card-title" style="float: left;">Data Kandidat</h3>
        <button class="btn btn-success btn-sm" style="float: right;" onclick="showFormModal()">+ Tambah</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal Form Tambah/Edit -->
<div id="modalForm" style="display:none; position: fixed; top: 20%; left: 50%; transform: translateX(-50%); background: white; padding: 20px; box-shadow: 0 0 10px gray; z-index: 999; width: 300px;">
  <h5 id="formTitle">Tambah Siswa</h5>
  <input type="text" id="namaInput" class="form-control mb-2" placeholder="Nama Siswa">
  <input type="text" id="kelasInput" class="form-control mb-2" placeholder="Kelas">
  <button class="btn btn-success btn-sm" onclick="saveForm()">Simpan</button>
  <button class="btn btn-secondary btn-sm" onclick="hideFormModal()">Batal</button>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalDelete" style="display:none; position: fixed; top: 30%; left: 50%; transform: translateX(-50%); background: white; padding: 20px; box-shadow: 0 0 10px gray; z-index: 999; width: 280px;">
  <p>Yakin ingin menghapus data ini?</p>
  <button class="btn btn-danger btn-sm" onclick="deleteConfirmed()">Ya, Hapus</button>
  <button class="btn btn-secondary btn-sm" onclick="hideDeleteModal()">Batal</button>
</div>

<script>
  let rowNumber = 2;
  let editingRow = null;
  let deletingRow = null;

  function showFormModal(editBtn = null) {
    document.getElementById('modalForm').style.display = 'block';
    if (editBtn) {
      document.getElementById('formTitle').textContent = "Edit Siswa";
      editingRow = editBtn.parentNode.parentNode;
      document.getElementById('namaInput').value = editingRow.cells[1].textContent;
      document.getElementById('kelasInput').value = editingRow.cells[2].textContent;
    } else {
      document.getElementById('formTitle').textContent = "Tambah Siswa";
      editingRow = null;
      document.getElementById('namaInput').value = '';
      document.getElementById('kelasInput').value = '';
    }
  }

  function hideFormModal() {
    document.getElementById('modalForm').style.display = 'none';
  }

  function saveForm() {
    const nama = document.getElementById('namaInput').value.trim();
    const kelas = document.getElementById('kelasInput').value.trim();

    if (!nama || !kelas) {
      alert("Nama dan Kelas harus diisi.");
      return;
    }

    if (editingRow) {
      editingRow.cells[1].textContent = nama;
      editingRow.cells[2].textContent = kelas;
      editingRow.cells[3].textContent = "1";
    } else {
      const tbody = document.getElementById('tableBody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td>${rowNumber++}.</td>
        <td>${nama}</td>
        <td>${kelas}</td>
        <td>1</td>
        <td>
          <button class="btn btn-sm btn-primary" onclick="editRow(this)">Edit</button>
          <button class="btn btn-sm btn-danger" onclick="confirmDelete(this)">Hapus</button>
        </td>
      `;
      tbody.appendChild(newRow);
    }

    hideFormModal();
  }

  function editRow(btn) {
    showFormModal(btn);
  }

  function confirmDelete(btn) {
    deletingRow = btn.parentNode.parentNode;
    document.getElementById('modalDelete').style.display = 'block';
  }

  function deleteConfirmed() {
    if (deletingRow) {
      deletingRow.remove();
      rowNumber = 1;
      document.querySelectorAll("#tableBody tr").forEach((tr) => {
        tr.cells[0].textContent = `${rowNumber++}.`;
      });
    }
    hideDeleteModal();
  }

  function hideDeleteModal() {
    document.getElementById('modalDelete').style.display = 'none';
    deletingRow = null;
  }
</script>
  <!-- Modal Form Tambah -->
  <div id="modalForm" style="display: none; position: fixed; top:20%; left:50%; transform: translateX(-50%); background: white; padding: 20px; box-shadow: 0 0 10px gray; z-index: 999;">
    <h5>Tambah Siswa</h5>
    <input type="text" id="namaInput" class="form-control mb-2" placeholder="Nama Siswa">
    <input type="text" id="kelasInput" class="form-control mb-2" placeholder="Kelas">
    <input type="number" id="suaraInput" class="form-control mb-2" placeholder="Jumlah Suara">
    <button class="btn btn-success btn-sm" onclick="addRow()">Simpan</button>
    <button class="btn btn-secondary btn-sm" onclick="hideAddModal()">Batal</button>
  </div>

  <script>
    let rowNumber = 2; // karena sudah ada 1 baris awal

    function showAddModal() {
      document.getElementById('modalForm').style.display = 'block';
    }

    function hideAddModal() {
      document.getElementById('modalForm').style.display = 'none';
      document.getElementById('namaInput').value = '';
      document.getElementById('kelasInput').value = '';
      document.getElementById('suaraInput').value = '';
    }

    function addRow() {
      const nama = document.getElementById('namaInput').value;
      const kelas = document.getElementById('kelasInput').value;
      const suara = document.getElementById('suaraInput').value;

      if (!nama || !kelas || !suara) {
        alert("Semua field harus diisi!");
        return;
      }

      const tbody = document.getElementById('tableBody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td>${rowNumber++}.</td>
        <td>${nama}</td>
        <td>${kelas}</td>
        <td>${suara}</td>
        <td>
          <button class="btn btn-sm btn-primary" onclick="editRow(this)">Edit</button>
          <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Hapus</button>
        </td>
      `;
      tbody.appendChild(newRow);
      hideAddModal();
    }

    function deleteRow(btn) {
      const row = btn.parentNode.parentNode;
      row.remove();
      rowNumber = 1;
      document.querySelectorAll("#tableBody tr").forEach((tr) => {
        tr.cells[0].textContent = `${rowNumber++}.`;
      });
    }

    function editRow(btn) {
      const row = btn.parentNode.parentNode;
      const nama = prompt("Edit Nama Siswa:", row.cells[1].textContent);
      const kelas = prompt("Edit Kelas:", row.cells[2].textContent);
      const suara = prompt("Edit Jumlah Suara:", row.cells[3].textContent);

      if (nama !== null && kelas !== null && suara !== null) {
        row.cells[1].textContent = nama;
        row.cells[2].textContent = kelas;
        row.cells[3].textContent = suara;
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

  <script>
    $(function () {
      $("#example100").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>