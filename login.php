<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $connection = new PDO('mysql:host=localhost;dbname=feni', 'root', '');
  $statement = $connection->prepare('select * from users where email=:email');
  $statement->execute([
    ":email" => $email
  ]);
  $user = $statement->fetch(PDO::FETCH_OBJ);
  if ($user) {
    if (password_verify($password, $user->password)) {
      $_SESSION['user'] = $user;
      header('Location: index.php');
    } else {
      echo 'password wrong';
    }
  }else {
    echo 'user not found on database';
  }
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
        <h2>Login</h2>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <p>Don't have account? <a href="register.php">Register Here</a></p>
          <div class="form-group">
            <button type="submit" class="btn btn-info">Login</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</body>
</html>