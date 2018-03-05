# register user 

~~~php
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
~~~


# login user 

~~~php
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
~~~

## redirect to authenticate route if user already logged in 

~~~php
// login.php and register.php file
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}
~~~

## redirect to login page route if user dont logged in but try to access authenticate route    

~~~php
// index.php // reverse logic 
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
~~~



