<?php
require '../config.php';
session_start();

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Proses simpan produk
if (isset($_POST['submit'])) {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $price       = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Upload gambar
    $imageName = $_FILES['image']['name'];
    $tmpName   = $_FILES['image']['tmp_name'];
    $error     = $_FILES['image']['error'];

    $imageNewName = '';
    if ($error === 0) {
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $allowed = ['jpg', 'jpeg', 'png', 'jfif'];

        if (in_array($ext, $allowed)) {
            $imageNewName = uniqid('product_', true) . '.' . $ext;
            move_uploaded_file($tmpName, '../uploads/' . $imageNewName);
        }
    }

    $query = "INSERT INTO products (name, price, description, image) 
              VALUES ('$name', '$price', '$description', '$imageNewName')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Produk berhasil ditambahkan');window.location='products.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk');</script>";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Tambah Produk</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>

<?php include 'footer.php'; ?>
