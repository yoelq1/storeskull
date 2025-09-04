<?php
session_start();
include 'admin/config.php';

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Update jumlah barang jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
}

// Ambil data produk dari database untuk menampilkan di keranjang
$cart_items = [];
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total_price += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Beranda</a>
        <a href="product.php">Produk</a>
        <a href="cart.php" class="active">Keranjang</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Keranjang Belanja</h2>
    <?php if (!empty($cart_items)): ?>
    <form method="POST">
        <table>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            <?php foreach($cart_items as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>
                    <input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                </td>
                <td>Rp <?php echo number_format($item['subtotal'],0,',','.'); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td><strong>Rp <?php echo number_format($total_price,0,',','.'); ?></strong></td>
            </tr>
        </table>
        <button type="submit" name="update_cart">Update Keranjang</button>
        <a href="checkout.php" class="btn">Checkout</a>
    </form>
    <?php else: ?>
        <p>Keranjang kosong.</p>
    <?php endif; ?>
</body>
</html>