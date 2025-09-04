<?php
// admin/index.php
include 'config.php';
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }

// stats
$prod_count = $conn->query("SELECT COUNT(*) AS c FROM products")->fetch_assoc()['c'];
$order_pending = $conn->query("SELECT COUNT(*) AS c FROM orders WHERE status='pending'")->fetch_assoc()['c'];
$order_done = $conn->query("SELECT COUNT(*) AS c FROM orders WHERE status='done'")->fetch_assoc()['c'];

?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<?php /* simple nav for admin */ ?>
<div style="max-width:1100px;margin:20px auto;">
  <h1>Admin Dashboard</h1>
  <p>Welcome, <?= htmlspecialchars($_SESSION['admin_user']) ?></p>
  <div style="display:flex;gap:12px;margin-top:12px;">
    <div style="padding:12px;background:#fff;border-radius:8px;box-shadow:0 6px 16px rgba(0,0,0,.08)">Products<br><strong><?= $prod_count ?></strong></div>
    <div style="padding:12px;background:#fff;border-radius:8px;box-shadow:0 6px 16px rgba(0,0,0,.08)">Pending<br><strong><?= $order_pending ?></strong></div>
    <div style="padding:12px;background:#fff;border-radius:8px;box-shadow:0 6px 16px rgba(0,0,0,.08)">Done<br><strong><?= $order_done ?></strong></div>
  </div>

  <hr style="margin:18px 0;">
  <a href="products.php">Manage Products</a> | <a href="orders.php">Manage Orders</a> | <a href="logout.php">Logout</a>
</div>
</body></html>