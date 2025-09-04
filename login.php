<?php
include "admin/config.php";
include "navbar.php";

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<div class="auth-container">
    <h2>Login</h2>
    <form method="POST" action="login_process.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Belum punya akun? <a href="register.php">Register</a></p>
        <p><a href="forgot_password.php">Lupa password?</a></p>
    </form>
</div>