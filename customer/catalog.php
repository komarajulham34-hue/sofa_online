<?php
session_start();
include '../config.php';

// fetch products
$res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$products = [];
while($r = mysqli_fetch_assoc($res)) $products[] = $r;

include '../header.php';
?>
<h3 class="mb-4">Katalog Sofa</h3>
<div class="row g-4">
  <?php if(empty($products)): ?>
    <div class="col-12"><div class="alert alert-info">Belum ada produk.</div></div>
  <?php endif; ?>

  <?php foreach($products as $p): ?>
    <div class="col-md-3">
      <div class="card sofa-card shadow-sm">
        <img src="../assets/img/<?=e($p['image']?:'sofa1.jpg')?>" class="w-100" alt="<?=e($p['name'])?>">
        <div class="card-body">
          <h6 class="card-title mb-1"><?=e($p['name'])?></h6>
          <p class="text-muted mb-2">Rp <?=number_format($p['price'])?></p>
          <a href="detail.php?id=<?=intval($p['id'])?>" class="btn btn-primary w-100">Detail</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php include '../footer.php'; ?>
