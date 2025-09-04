<?php
session_start();
include 'admin/config.php';

// Ambil semua produk dari database
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="index.php">Beranda</a>
        <a href="product.php" class="active">Produk</a>
        <a href="cart.php">Keranjang</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="product-container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product-card">
                <img src="assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                <div class="product-buttons">
                    <button onclick="addToCart(<?php echo $row['id']; ?>)">Masukkan Keranjang</button>
                    <button onclick="buyNow(<?php echo $row['id']; ?>)">Buy Now</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>