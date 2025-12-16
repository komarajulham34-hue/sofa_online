<?php
session_start();
include '../config.php';

$id = intval($_GET['id'] ?? 0);
$res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id LIMIT 1");
$product = mysqli_fetch_assoc($res) ?: null;

if (!$product) {
    header('Location: catalog.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qty = max(1, intval($_POST['qty'] ?? 1));

    // simple cart stored in session
    $oldQty = $_SESSION['cart'][$id]['qty'] ?? 0;

    $_SESSION['cart'][$id] = [
        'id'    => $id,
        'name'  => $product['name'],
        'price' => $product['price'],
        'qty'   => $oldQty + $qty
    ];

    header('Location: cart.php');
    exit;
}

include '../header.php';
?>

<div class="row">
  <div class="col-md-6">
    <img 
      src="<?= $product['image'] ? '../uploads/'.e($product['image']) : '../assets/img/sofa1.jpg' ?>" 
      class="w-100 rounded shadow-sm" 
      alt=""
    >
  </div>

  <div class="col-md-6">
    <h3 class="fw-bold"><?= e($product['name']) ?></h3>

    <p class="text-muted fs-5">Rp <?= number_format($product['price']) ?></p>

    <p><?= nl2br(e($product['description'])) ?></p>

    <form method="post" class="d-flex gap-2 align-items-center mt-3">
      <input type="number" name="qty" class="form-control w-25" value="1" min="1">
      <button class="btn btn-primary">Tambah ke Keranjang</button>
    </form>
  </div>
</div>

<?php include '../footer.php'; ?>
