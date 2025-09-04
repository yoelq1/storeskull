<?php
session_start();
include 'admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $products = $_SESSION['cart'] ?? [];
    
    if (!empty($products)) {
        foreach ($products as $id => $qty) {
            $stmt = $conn->prepare("INSERT INTO orders (product_id, quantity, phone, status) VALUES (?, ?, ?, 'pending')");
            $stmt->bind_param("iis", $id, $qty, $phone);
            $stmt->execute();
        }
        // Kosongkan keranjang setelah checkout
        $_SESSION['cart'] = [];
        $success_msg = "Pesanan Anda telah terkirim. Tunggu admin menghubungi Anda.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Beranda</a>
        <a href="product.php">Produk</a>
        <a href="cart.php">Keranjang</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Checkout</h2>
    <?php if(isset($success_msg)): ?>
        <p style="color:green;"><?php echo $success_msg; ?></p>
        <a href="index.php">Kembali ke Beranda</a>
    <?php else: ?>
    <form method="POST" onsubmit="return validateCheckout()">
        <label>Nomor Telepon:</label>
        <input type="text" name="phone" id="phone" required>
        <button type="submit">Konfirmasi Pesanan</button>
    </form>
    <?php endif; ?>
</body>
</html>