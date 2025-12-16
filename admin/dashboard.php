<?php
session_start();
include '../config.php';

// Very simple admin check (replace with proper auth)
if (empty($_SESSION['admin'])) {
    header('Location: ../login.php'); exit;
}

// stats
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM products");
$productCount = mysqli_fetch_assoc($r)['c'] ?? 0;
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM orders");
$orderCount = mysqli_fetch_assoc($r)['c'] ?? 0;
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM pickups");
$pickupCount = mysqli_fetch_assoc($r)['c'] ?? 0;

include '../header.php';
?>
<h3 class="mb-4">Dashboard Admin</h3>
<div class="row g-3">
  <div class="col-md-4"><div class="card p-3 shadow-sm"><h6>Total Produk</h6><p class="fs-3 fw-bold"><?=$productCount?></p></div></div>
  <div class="col-md-4"><div class="card p-3 shadow-sm"><h6>Order Masuk</h6><p class="fs-3 fw-bold"><?=$orderCount?></p></div></div>
  <div class="col-md-4"><div class="card p-3 shadow-sm"><h6>Jadwal Pickup</h6><p class="fs-3 fw-bold"><?=$pickupCount?></p></div></div>
</div>
<?php include '../footer.php'; ?>
