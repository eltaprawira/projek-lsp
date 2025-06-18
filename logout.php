<?php
session_start();
session_destroy(); // Menghapus semua data session
header("Location: login-admin.php"); // Kembali ke halaman login
exit;