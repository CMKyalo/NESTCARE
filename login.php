<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email = strtolower(trim($_POST['email']));
  $password = $_POST['password'];

  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
  $stmt->execute([$email]);
  $user = $stmt->fetch();
  if($user && password_verify($password, $user['password'])){
    // set session user (remove password)
    unset($user['password']);
    $_SESSION['user'] = $user;
    header('Location: dashboard_'.$user['role'].'.php'); exit;
  } else {
    header('Location: index.php?m=' . urlencode('Invalid credentials')); exit;
  }
} else {
  header('Location: index.php'); exit;
}