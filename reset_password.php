<?php
include "admin/config.php";
include "navbar.php";

if (!isset($_SESSION['reset_code'])) {
    header("Location: forgot_password.php");
    exit;
}
?>
<div class="auth-container">
    <h2>Reset Password</h2>
    <form method="POST" action="reset_process.php">
        <input type="text" name="code" placeholder="Masukkan kode verifikasi" required>
        <input type="password" name="newpass" placeholder="Password Baru" required>
        <input type="password" name="confirm" placeholder="Konfirmasi Password Baru" required>
        <button type="submit">Reset Password</button>
    </form>
</div>