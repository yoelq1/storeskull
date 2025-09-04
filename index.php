<?php include "admin/config.php"; ?>
<?php include "navbar.php"; ?>

<div class="product-container">
    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <img src="assets/images/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
            <h3><?= $row['name'] ?></h3>
            <p><?= $row['description'] ?></p>
            <div class="price">Rp <?= number_format($row['price']) ?></div>
            <a href="checkout.php?buy=<?= $row['id'] ?>" class="btn btn-buy">Buy</a>
            <a href="cart.php?add=<?= $row['id'] ?>" class="btn btn-cart">Add to Cart</a>
        </div>
    <?php endwhile; ?>
</div>