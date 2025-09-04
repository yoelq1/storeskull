<?php
include "admin/config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$q = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($q->num_rows > 0) {
    $user = $q->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
        exit;
    }
}
echo "<script>alert('Username atau password salah');window.location='login.php';</script>";