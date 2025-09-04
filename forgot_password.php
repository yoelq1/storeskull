<?php
include "admin/config.php";
include "navbar.php";
?>
<div class="auth-container">
    <h2>Lupa Password</h2>
    <form method="POST" action="forgot_process.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="contact" placeholder="Email atau No Telepon" required>
        <button type="submit">Kirim Kode Verifikasi</button>
    </form>
</div>