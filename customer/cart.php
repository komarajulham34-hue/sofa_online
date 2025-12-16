<?php
session_start();
include '../config.php';

// handle remove
if (isset($_GET['remove'])) {
    $rid = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$rid])) unset($_SESSION['cart'][$rid]);
    header('Location: cart.php');
    exit;
}

// handle update qty via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach($_POST['qty'] as $id => $q) {
        $id = intval($id);
        $q = max(1, intval($q));
        if(isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]['qty'] = $q;
    }
    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];

include '../header.php';
?>
<h3 class="mb-3">Keranjang Belanja</h3>
<form method="post">
  <table class="table table-hover bg-white shadow-sm rounded">
    <thead class="table-light">
      <tr><th>Sofa</th><th>Harga</th><th style="width:110px">Qty</th><th>Total</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php $grand=0; foreach($cart as $c): $total = $c['price']*$c['qty']; $grand += $total; ?>
      <tr>
        <td><?=e($c['name'])?></td>
        <td>Rp <?=number_format($c['price'])?></td>
        <td><input type="number" name="qty[<?=intval($c['id'])?>]" value="<?=intval($c['qty'])?>" min="1" class="form-control"></td>
        <td>Rp <?=number_format($total)?></td>
        <td><a href="cart.php?remove=<?=intval($c['id'])?>" class="btn btn-danger btn-sm">Hapus</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="d-flex justify-content-between align-items-center">
    <div>
      <button type="submit" name="update" class="btn btn-secondary">Update Keranjang</button>
    </div>
    <div class="text-end">
      <h5>Grand Total: Rp <?=number_format($grand)?></h5>
      <a href="checkout.php" class="btn btn-success btn-lg">Checkout</a>
    </div>
  </div>
</form>
<?php include '../footer.php'; ?>
