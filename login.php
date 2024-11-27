<?php

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'connect.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  try {

    $sql = $con->prepare("SELECT * FROM `registration` WHERE username = :username AND password = :password");

    $sql->bindParam(':username', $username, PDO::PARAM_STR);
    $sql->bindParam(':password', $password, PDO::PARAM_STR);

    $sql->execute();

    if ($sql->rowCount() > 0) {
      $login = 1;

      session_start();
      $_SESSION['username'] = $username;
      header('Location: home.php');
      exit();
    } else {
      $invalid = 1;
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Login Page</title>
</head>

<body>

  <?php
  if ($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ohh no Sorry</strong> Invalid credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong>You are successfully logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>


  <h1 class="text-center mt-5">Login to our website</h1>
  <div class="container mt-5">
    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">username</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="username" autocomplete="off" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>




</body>

</html>