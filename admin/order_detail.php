<?php
// admin/order_detail.php
include 'config.php';
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
if (!isset($_GET['id'])) { header("Location: orders.php"); exit; }

$id = (int)$_GET['id'];
$order = $conn->query("SELECT o.*, u.username FROM orders o LEFT JOIN users u ON o.user_id=u.id WHERE o.id=$id")->fetch_assoc();
$items = $conn->query("SELECT oi.*, p.name FROM order_items oi LEFT JOIN products p ON oi.product_id=p.id WHERE oi.order_id=$id");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Order Detail</title>
<link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<div style="max-width:900px;margin:20px auto;background:#fff;padding:16px;border-radius:8px;">
  <h2>Detail Pesanan #<?= $order['id'] ?></h2>
  <p><b>User:</b> <?= htmlspecialchars($order['username'] ?? 'Guest') ?></p>
  <p><b>Phone:</b> <?= htmlspecialchars($order['phone']) ?></p>
  <p><b>Status:</b> <?= ucfirst($order['status']) ?></p>
  <p><b>Tanggal:</b> <?= $order['created_at'] ?></p>

  <h3>Items</h3>
  <table border="1" cellpadding="8" cellspacing="0" style="width:100%;">
    <tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
    <?php $grand = 0; while($it = $items->fetch_assoc()): 
      $sub = $it['quantity'] * $it['price'];
      $grand += $sub;
    ?>
      <tr>
        <td><?= htmlspecialchars($it['name']) ?></td>
        <td><?= $it['quantity'] ?></td>
        <td>Rp <?= number_format($it['price']) ?></td>
        <td>Rp <?= number_format($sub) ?></td>
      </tr>
    <?php endwhile; ?>
    <tr><th colspan="3">Total</th><th>Rp <?= number_format($grand) ?></th></tr>
  </table>

  <p style="margin-top:10px;"><a href="orders.php">← Back to Orders</a></p>
</div>
</body></html>