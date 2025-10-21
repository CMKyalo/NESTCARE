<?php
require 'config.php';
require_login();

if(!in_array($_SESSION['user']['role'], ['admin','staff'])) {
  header('Location: index.php'); exit;
}

$err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = trim($_POST['name']);
  $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
  $gender = $_POST['gender'] ?? 'male';
  $description = trim($_POST['description']);
  $photo = null;

  if(!empty($_FILES['photo']['name'])){
    $targetDir = 'uploads/';
    if(!is_dir($targetDir)) mkdir($targetDir,0755,true);
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $fname = uniqid('c_').'.'.$ext;
    $target = $targetDir . $fname;
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)){
      $photo = $fname;
    }
  }

  $stmt = $pdo->prepare('INSERT INTO children (name,dob,gender,description,photo,created_by) VALUES (?,?,?,?,?,?)');
  $stmt->execute([$name,$dob,$gender,$description,$photo,$_SESSION['user']['id']]);
  header('Location: dashboard_'.$_SESSION['user']['role'].'.php'); exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Child</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h4>Add Child</h4>
  <?php if($err) echo "<div class='alert alert-danger'>$err</div>"; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label>Name</label><input name="name" class="form-control" required></div>
    <div class="mb-3"><label>DOB</label><input name="dob" type="date" class="form-control"></div>
    <div class="mb-3"><label>Gender</label>
      <select name="gender" class="form-select"><option>male</option><option>female</option><option>other</option></select>
    </div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
    <div class="mb-3"><label>Photo</label><input name="photo" type="file" class="form-control"></div>
    <button class="btn btn-primary">Save</button>
    <a href="dashboard_<?= $_SESSION['user']['role'] ?>.php" class="btn btn-link">Cancel</a>
  </form>
</div>
</body>
</html>
