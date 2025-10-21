<?php
require 'config.php';
if(is_logged_in()){
  $role = $_SESSION['user']['role'];
  header("Location: dashboard_{$role}.php"); exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>NestCare — Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-3">NestCare — Login</h3>
          <?php if(!empty($_GET['m'])): ?>
            <div class="alert alert-info"><?=htmlspecialchars($_GET['m'])?></div>
          <?php endif; ?>
          <form method="post" action="login.php">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input name="email" type="email" required class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input name="password" type="password" required class="form-control">
            </div>
            <button class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-link">Register</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>