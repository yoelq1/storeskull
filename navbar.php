<div class="navbar">
    <div class="logo"><a href="index.php">WebStoreSkull</a></div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="history.php">History</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="logout.php" class="btn-logout">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php" class="btn-login">Login</a></li>
            <li><a href="register.php" class="btn-register">Register</a></li>
        <?php endif; ?>
    </ul>
</div>