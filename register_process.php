<?php
include "admin/config.php";

$username = $_POST['username'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$password = $_POST['password'];
$confirm  = $_POST['confirm'];

if ($password !== $confirm) {
    echo "<script>alert('Konfirmasi password tidak sama');window.location='register.php';</script>";
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$q = $conn->query("INSERT INTO users (username,password,email,phone) 
VALUES ('$username','$hash','$email','$phone')");

if ($q) {
    echo "<script>alert('Registrasi berhasil, silakan login');window.location='login.php';</script>";
} else {
    echo "<script>alert('Username sudah digunakan');window.location='register.php';</script>";
}