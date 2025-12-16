<?php
require '../config.php';
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id=$id"));
$customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=".$order['user_id']));
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3 class="mb-3">Order Detail</h3>

    <div class="card p-4 shadow-sm">

        <h5 class="mb-3">Customer Information</h5>
        <p><strong>Name:</strong> <?= $customer['name'] ?></p>
        <p><strong>Email:</strong> <?= $customer['email'] ?></p>
        <p><strong>Phone:</strong> <?= $customer['phone'] ?></p>

        <hr>

        <h5 class="mb-3">Order Information</h5>
        <p><strong>Pickup Address:</strong> <?= $order['pickup_address'] ?></p>
        <p><strong>Pickup Date:</strong> <?= $order['pickup_date'] ?></p>
        <p><strong>Status:</strong> <span class="badge bg-primary"><?= $order['status'] ?></span></p>

        <hr>

        <h5>Order Note</h5>
        <p><?= $order['note'] ?></p>

        <a href="orders.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

<?php include 'footer.php'; ?>
