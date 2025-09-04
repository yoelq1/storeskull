<?php
include "admin/config.php";

$username = $_POST['username'];
$contact  = $_POST['contact'];

$q = $conn->query("SELECT * FROM users WHERE username='$username' AND (email='$contact' OR phone='$contact')");
if ($q->num_rows > 0) {
    $code = rand(100000,999999);
    $_SESSION['reset_code'] = $code;
    $_SESSION['reset_user'] = $username;
    // Simulasi kirim kode (tampilkan saja)
    echo "<script>alert('Kode verifikasi: $code');window.location='reset_password.php';</script>";
} else {
    echo "<script>alert('Data tidak cocok');window.location='forgot_password.php';</script>";
}