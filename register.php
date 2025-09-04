<?php
include "admin/config.php";
include "navbar.php";

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<div class="auth-container">
    <h2>Register</h2>
    <form method="POST" action="register_process.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="No Telepon" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Konfirmasi Password" required>
        <button type="submit">Register</button>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>