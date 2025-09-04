<?php
// admin/login.php
include 'config.php';
if (isset($_SESSION['admin_id'])) header("Location: index.php");

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $conn->real_escape_string(trim($_POST['username'] ?? ''));
    $p = $_POST['password'] ?? '';
    $res = $conn->query("SELECT * FROM users WHERE username='$u' AND role='admin' LIMIT 1");
    if ($res && $res->num_rows>0) {
        $row = $res->fetch_assoc();
        if (password_verify($p, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_user'] = $row['username'];
            header("Location: index.php"); exit;
        } else $msg = "Password salah.";
    } else $msg = "Admin tidak ditemukan.";
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Admin Login</title>
<link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<div style="max-width:420px;margin:60px auto;">
  <h2>Admin Login</h2>
  <?php if($msg) echo "<div style='color:red;margin-bottom:10px;'>$msg</div>"; ?>
  <form method="post">
    <input name="username" placeholder="Username" required style="width:100%;padding:10px;margin:6px 0;">
    <input name="password" type="password" placeholder="Password" required style="width:100%;padding:10px;margin:6px 0;">
    <button type="submit" style="padding:10px 15px;">Login</button>
  </form>
</div>
</body></html>