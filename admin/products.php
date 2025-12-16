<?php
session_start();
include '../config.php';
if (empty($_SESSION['admin'])) { header('Location: ../login.php'); exit; }

// fetch products
$res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$rows = [];
while($r = mysqli_fetch_assoc($res)) $rows[] = $r;

include '../header.php';
?>
<h3 class="mb-3">Manajemen Produk</h3>
<a href="add_product.php" class="btn btn-primary mb-3">Tambah Produk</a>
<table class="table table-striped bg-white shadow-sm">
  <thead><tr><th>Nama</th><th>Harga</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($rows as $r): ?>
      <tr>
        <td><?=e($r['name'])?></td>
        <td>Rp <?=number_format($r['price'])?></td>
        <td>
          <a href="edit_product.php?id=<?=intval($r['id'])?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="delete_product.php?id=<?=intval($r['id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include '../footer.php'; ?>
