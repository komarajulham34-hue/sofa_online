<?php
session_start();
include 'config.php';

// very simple admin login for demo (replace with hashed password and proper auth)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    // Demo: check admin table or static
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        // assume passwords stored plain in demo; in real use password_verify
        if ($row['password'] === $pass) {
            $_SESSION['admin'] = $row['id'];
            header('Location: admin/dashboard.php');
            exit;
        }
    }
    $error = "Email atau password salah.";
}
include 'header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card p-4 shadow-sm">
      <h4 class="mb-3 text-center">Admin Login</h4>
      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?=e($error)?></div>
      <?php endif; ?>
      <form method="post" novalidate>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input required type="email" name="email" class="form-control" />
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input required type="password" name="password" class="form-control" />
        </div>
        <button class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
