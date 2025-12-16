<?php
session_start();
include '../config.php';
if (empty($_SESSION['admin'])) { header('Location: ../login.php'); exit; }

$res = mysqli_query($conn, "SELECT * FROM pickups ORDER BY id DESC");
$pickup = [];
while($r = mysqli_fetch_assoc($res)) $pickup[] = $r;

include '../header.php';
?>
<h3 class="mb-3">Jadwal Pickup</h3>
<table class="table table-hover bg-white shadow-sm">
  <thead><tr><th>Nama</th><th>Alamat</th><th>Waktu</th><th>Status</th></tr></thead>
  <tbody>
    <?php foreach($pickup as $p): ?>
      <tr>
        <td><?=e($p['name'])?></td>
        <td><?=e($p['address'])?></td>
        <td><?=e($p['pickup_time'])?></td>
        <td><span class="badge bg-success"><?=e($p['status'])?></span></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include '../footer.php'; ?>
