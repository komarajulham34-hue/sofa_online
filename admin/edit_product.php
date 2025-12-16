<?php
require '../config.php';
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if(isset($_POST['submit'])) {
    $name       = $_POST['name'];
    $price      = $_POST['price'];
    $description= $_POST['description'];

    $image = $product['image'];

    if($_FILES['image']['name'] != "") {
        // hapus lama
        if($image != "" && file_exists("../uploads/".$image)) {
            unlink("../uploads/".$image);
        }

        $image = "IMG_".time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    }

    mysqli_query($conn, "UPDATE products SET 
        name='$name', 
        price='$price', 
        description='$description',
        image='$image'
        WHERE id=$id");

    header("Location: products.php?updated=1");
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3 class="mb-3">Edit Product</h3>

    <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (Rp)</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= $product['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="../uploads/<?= $product['image'] ?>" width="150" class="rounded border">
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<?php include 'footer.php'; ?>
