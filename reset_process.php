<?php
include "admin/config.php";

$code     = $_POST['code'];
$newpass  = $_POST['newpass'];
$confirm  = $_POST['confirm'];

if ($code != $_SESSION['reset_code']) {
    echo "<script>alert('Kode verifikasi salah');window.location='reset_password.php';</script>";
    exit;
}
if ($newpass !== $confirm) {
    echo "<script>alert('Konfirmasi password tidak sama');window.location='reset_password.php';</script>";
    exit;
}

$username = $_SESSION['reset_user'];
$user = $conn->query("SELECT * FROM users WHERE username='$username'")->fetch_assoc();

if (password_verify($newpass, $user['password'])) {
    echo "<script>alert('Password baru tidak boleh sama dengan password lama');window.location='reset_password.php';</script>";
    exit;
}

$hash = password_hash($newpass, PASSWORD_DEFAULT);
$conn->query("UPDATE users SET password='$hash' WHERE username='$username'");

unset($_SESSION['reset_code']);
unset($_SESSION['reset_user']);

echo "<script>alert('Password berhasil direset, silakan login');window.location='login.php';</script>";