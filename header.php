<?php
// header.php - include in pages after session_start() and include 'config.php'
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sofa Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body { padding-top: 72px; background:#f5f7fb; }
      .sofa-card img { max-height:200px; object-fit:cover; border-radius:10px; }
      .card { border-radius:12px; }
      .site-footer { background:#fff; border-top:1px solid #e9ecef; padding:18px 0; margin-top:36px; }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/sofa_online/customer/catalog.php">Sofa Online</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/sofa_online/customer/catalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="/sofa_online/customer/cart.php">Keranjang</a></li>
        </ul>
        <div class="d-flex">
          <a class="btn btn-outline-primary me-2" href="/sofa_online/login.php">Login Admin</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container py-4">
