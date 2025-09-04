<?php
session_start();
include 'admin/config.php';

// Misal user diidentifikasi dari session username
$user_phone = $_SESSION['phone'] ?? null;
if(!$user_phone){
    header("Location: login.html");
    exit;
}

// Ambil history pesanan user
$result = $conn->query("SELECT o.id, p.name, o.quantity, o.status 
                        FROM orders o JOIN products p ON o.product_id=p.id 
                        WHERE o.phone='$user_phone' ORDER BY o.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History Pembelian</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar">
    <a href="index.php">Beranda</a>
    <a href="product.php">Produk</a>
    <a href="cart.php">Keranjang</a>
    <a href="history.php" class="active">History</a>
    <a href="logout.php">Logout</a>
</nav>

<h2>History Pembelian</h2>
<?php if($result->num_rows > 0): ?>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Status</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
<p>Belum ada riwayat pembelian.</p>
<?php endif; ?>
</body>
</html>