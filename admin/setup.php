<?php
// admin/setup.php
set_time_limit(0);
$host = "localhost";
$user = "root";
$pass = "";
$db   = "webstoreskull";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// buat database jika belum ada
$conn->query("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db($db);

// tabel users
$conn->query("CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255),
  email VARCHAR(100),
  phone VARCHAR(30),
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

// tabel products
$conn->query("CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  description TEXT,
  price INT DEFAULT 0,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

// tabel orders
$conn->query("CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  phone VARCHAR(30),
  total INT DEFAULT 0,
  status ENUM('pending','done','batal') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(user_id)
) ENGINE=InnoDB");

// tabel order_items
$conn->query("CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  price INT,
  INDEX(order_id),
  INDEX(product_id)
) ENGINE=InnoDB");

// tambah admin default jika belum ada
$res = $conn->query("SELECT id FROM users WHERE role='admin' LIMIT 1");
if ($res->num_rows == 0) {
    $pw = password_hash("admin123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username,password,email,phone,role) VALUES ('admin','$pw','admin@mail.com','08123456789','admin')");
}

echo "✅ Setup lengkap — database & tabel dibuat, admin default username: <strong>admin</strong>, password: <strong>admin123</strong>.";