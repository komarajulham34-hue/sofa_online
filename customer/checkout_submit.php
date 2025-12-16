<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

$fullname = mysqli_real_escape_string($conn, $_POST['fullname'] ?? '');
$address  = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
$phone    = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');

$total = 0;
foreach($cart as $c) {
    $total += $c['price'] * $c['qty'];
}

// --- Detect columns available in orders table ---
$cols = [];
$res = mysqli_query($conn, "SHOW COLUMNS FROM orders");
while ($r = mysqli_fetch_assoc($res)) {
    $cols[] = $r['Field'];
}

// --- Build dynamic insert (only columns that exist) ---
$data = [];

if (in_array('customer_name', $cols)) $data['customer_name'] = "'$fullname'";
if (in_array('fullname', $cols))      $data['fullname']      = "'$fullname'";

if (in_array('address', $cols))       $data['address']       = "'$address'";
if (in_array('phone', $cols))         $data['phone']         = "'$phone'";

if (in_array('items', $cols))         $data['items']         = "'" . mysqli_real_escape_string($conn, json_encode(array_values($cart))) . "'";
if (in_array('total', $cols))         $data['total']         = $total;

if (in_array('status', $cols))        $data['status']        = "'pending'";
if (in_array('created_at', $cols))    $data['created_at']    = "NOW()";

// Fallback minimal (supaya order tetap masuk walau tabel minim)
if (empty($data) && in_array('total', $cols)) {
    $data['total'] = $total;
}

// Build query
$fields = implode(",", array_keys($data));
$values = implode(",", array_values($data));

$q = "INSERT INTO orders ($fields) VALUES ($values)";
$ok = mysqli_query($conn, $q);

if ($ok) {
    $order_id = mysqli_insert_id($conn);
    unset($_SESSION['cart']);

    header("Location: pickup_request.php?order_id=$order_id");
    exit;
} else {
    echo "Query error: " . mysqli_error($conn) . "<br>";
    echo "Query: " . $q;
}
