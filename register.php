<?php 
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_BCRYPT);
  $connection = new PDO('mysql:host=localhost;dbname=feni', 'root', '');
  $statement = $connection->prepare('insert into users (name, email, password) values(:name, :email, :password)');
  $statement->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $password,
  ]);
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-primary">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>Register</h2>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <p>Already have an account? <a href="login.php">Login Here.</a></p>
          <div class="form-group">
            <button type="submit" class="btn btn-info">Register</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</body>
</html>