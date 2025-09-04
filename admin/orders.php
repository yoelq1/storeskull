<?php
session_start();
include 'config.php';

// Update status pesanan jika tombol ditekan
if(isset($_GET['action'], $_GET['id'])){
    $id = intval($_GET['id']);
    if($_GET['action'] === 'done'){
        $conn->query("UPDATE orders SET status='done' WHERE id=$id");
    } elseif($_GET['action'] === 'batal'){
        $conn->query("UPDATE orders SET status='batal' WHERE id=$id");
    }
}

// Ambil semua pesanan
$result = $conn->query("SELECT o.id, p.name, o.quantity, o.phone, o.status 
                        FROM orders o JOIN products p ON o.product_id=p.id 
                        ORDER BY o.id DESC");
?>

<h2>Daftar Pesanan</h2>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Nomor Telepon</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <?php if($row['status'] === 'pending'): ?>
            <a href="?action=done&id=<?php echo $row['id']; ?>">Done</a> | 
            <a href="?action=batal&id=<?php echo $row['id']; ?>">Batal</a>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>