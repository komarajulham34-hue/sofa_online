<?php
session_start();
include '../config.php';
if (empty($_SESSION['admin'])) { header('Location: ../login.php'); exit; }

$res = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
$orders = [];
while($r = mysqli_fetch_assoc($res)) $orders[] = $r;

include '../header.php';
?>
<h3 class="mb-3">Daftar Pesanan</h3>
<table class="table table-bordered bg-white shadow-sm">
  <thead class="table-light"><tr><th>ID</th><th>Nama</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($orders as $o): ?>
      <tr>
        <td><?=intval($o['id'])?></td>
        <td><?=e($o['customer_name'])?></td>
        <td>Rp <?=number_format($o['total'])?></td>
        <td><span class="badge bg-info"><?=e($o['status'])?></span></td>
        <td><a href="order_detail.php?id=<?=intval($o['id'])?>" class="btn btn-sm btn-primary">Detail</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include '../footer.php'; ?>
