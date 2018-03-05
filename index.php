<?php 
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>You are in Home page <a href="logout.php">Logout</a></h2>
      </div>
      <div class="card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione iure, voluptatum magni eos, dolorem perspiciatis ipsa aspernatur animi porro quia repellendus quis. Tempora laudantium placeat, quas facere neque hic corrupti!</p>
      </div>
    </div>
  </div>
</body>
</html>