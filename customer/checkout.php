<?php
session_start();
include '../config.php';

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

include '../header.php';
?>
<h3 class="mb-3">Checkout</h3>
<form method="post" action="checkout_submit.php" class="bg-white p-4 shadow-sm rounded">
  <div class="mb-3">
    <label class="form-label">Nama Lengkap</label>
    <input required type="text" name="fullname" class="form-control" />
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat Lengkap</label>
    <textarea required name="address" class="form-control" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Nomor HP</label>
    <input required type="text" name="phone" class="form-control" />
  </div>
  <button class="btn btn-primary btn-lg w-100">Kirim Pesanan</button>
</form>
<?php include '../footer.php'; ?>
