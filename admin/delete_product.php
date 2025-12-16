<?php
require '../config.php';
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$prod = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM products WHERE id=$id"));

if($prod && $prod['image'] != "" && file_exists("../uploads/".$prod['image'])) {
    unlink("../uploads/".$prod['image']);
}

mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: products.php?deleted=1");
exit;
?>
