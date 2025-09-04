<?php
include "admin/config.php";

if (!isset($_SESSION['user']) || !isset($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$phone   = $_POST['phone'];
$total   = 0;

// hitung total
foreach ($_SESSION['cart'] as $id => $qty) {
    $p = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
    $total += $p['price'] * $qty;
}

// buat order
$conn->query("INSERT INTO orders (user_id, phone, total) VALUES ($user_id,'$phone',$total)");
$order_id = $conn->insert_id;

// simpan detail item
foreach ($_SESSION['cart'] as $id => $qty) {
    $p = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
    $price = $p['price'];
    $conn->query("INSERT INTO order_items (order_id,product_id,quantity,price)
    VALUES ($order_id,$id,$qty,$price)");
}

unset($_SESSION['cart']);
echo "<script>alert('Pesanan anda sudah terkirim, tunggu admin menghubungi anda.');window.location='history.php';</script>";