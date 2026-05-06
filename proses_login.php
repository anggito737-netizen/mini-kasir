<?php
session_start();
include "koneksi.php";

$user = $_POST['username'];
$pass = $_POST['password'];

$data = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");

if (mysqli_num_rows($data) > 0) {
    $d = mysqli_fetch_assoc($data);
    $_SESSION['role'] = $d['role'];
    $_SESSION['user_id'] = $d['id_user'];
    $_SESSION['username'] = $d['username'];

    if ($d['role'] == 'admin')
        header("location:admin.php");
    else
        header("location:kasir.php");
} else {
    header("location:login.php?error=1");
}
?>