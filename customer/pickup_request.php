<?php
session_start();
include '../config.php';

// Accepts GET order_id to show confirmation OR POST to submit pickup schedule (for admin)
$order_id = intval($_GET['order_id'] ?? 0);
$order = [];
if ($order_id) {
  $res = mysqli_query($conn, "SELECT * FROM orders WHERE id=$order_id LIMIT 1");
  $order = mysqli_fetch_assoc($res) ?: [];
}

include '../header.php';
?>
<h3 class="mb-3">Permintaan Pickup</h3>

<?php if($order): ?>
  <div class="alert alert-success">
    Pesanan Anda (ID <strong><?=intval($order['id'])?></strong>) telah dibuat. Kami akan menghubungi untuk jadwal pickup.
  </div>
<?php else: ?>
  <div class="alert alert-info">Tidak ada ID pesanan. Kembali ke <a href="catalog.php">katalog</a>.</div>
<?php endif; ?>

<?php include '../footer.php'; ?>

