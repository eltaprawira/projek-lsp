<?php
// echo $_POST['email'];
// echo $_POST['password'];
session_start();

if ($_POST['email'] == 'elta@gmail.com' && $_POST['password']== '12345'){
//    echo "Authentication Succes";
   $_SESSION ['email'] = $_POST['email'];
   header('Location:index.php');
}else {
    header('Location:login-admin.php');
}