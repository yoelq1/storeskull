<?php
// admin/products.php
include 'config.php';
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }

$msg = '';
// create images directory if not exists
$imagesDir = __DIR__ . "/../images/";
if (!is_dir($imagesDir)) mkdir($imagesDir, 0777, true);

// add product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $conn->real_escape_string(trim($_POST['name'] ?? ''));
    $desc = $conn->real_escape_string(trim($_POST['description'] ?? ''));
    $price = (int)($_POST['price'] ?? 0);

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $fn = time() . "_" . preg_replace('/[^A-Za-z0-9_\-\.]/','_', basename($_FILES['image']['name']));
        $dest = $imagesDir . $fn;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
            $stmt = $conn->prepare("INSERT INTO products (name,description,price,image) VALUES (?,?,?,?)");
            $stmt->bind_param("ssis", $name, $desc, $price, $fn);
            $stmt->execute();
            $stmt->close();
            $msg = "Produk berhasil ditambahkan.";
        } else $msg = "Gagal upload gambar.";
    } else $msg = "Pilih gambar produk.";
}

// delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $r = $conn->query("SELECT image FROM products WHERE id=$id")->fetch_assoc();
    if ($r && $r['image']) {
        @unlink($imagesDir . $r['image']);
    }
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: products.php");
    exit;
}

$products = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Manage Products</title>
<link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<div style="max-width:1100px;margin:20px auto;">
  <h2>Manage Products</h2>
  <?php if($msg) echo "<div style='margin-bottom:10px;color:green;'>$msg</div>"; ?>
  <form method="post" enctype="multipart/form-data" style="display:flex;gap:8px;align-items:center;margin-bottom:18px;">
    <input name="name" placeholder="Nama produk" required>
    <input name="price" type="number" placeholder="Harga" required>
    <input name="description" placeholder="Deskripsi singkat">
    <input type="file" name="image" accept="image/*" required>
    <button type="submit" name="add">Tambah</button>
  </form>

  <table border="1" cellpadding="8" cellspacing="0" style="width:100%;background:#fff;">
    <tr><th>ID</th><th>Gambar</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
    <?php while($p = $products->fetch_assoc()): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><img src="../images/<?= htmlspecialchars($p['image']) ?>" width="80"></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td>Rp <?= number_format($p['price']) ?></td>
        <td><a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Hapus produk?')">Hapus</a></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <p style="margin-top:10px;"><a href="index.php">← Dashboard</a></p>
</div>
</body></html>