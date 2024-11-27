<?php

$succes=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];



   $sql = $con->prepare("Select * from `registration` where 
   username=?");
   $sql->bindParam(1,$username,PDO::PARAM_STR);
   $sql->execute();


    if($sql->rowCount()>0){
        //echo "User already exist";
        $user=1;
    }else{

    $sql = $con->prepare("insert into `registration`(username,password)
    values(?, ?)");
    $sql->bindParam(1,$username,PDO::PARAM_STR);
    $sql->bindParam(2,$password,PDO::PARAM_STR);

    $result=$sql->execute();

    if($result){
        //echo " Signup successfully";
        $succes=1;
        header('location:login.php');
    }else{
      die("Error: Unable to sign up. Please try again.");
    }
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

    <title>Sign Up</title>
  </head>
  <body>

  

  <?php
  if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ohh no Sorry</strong> User already exist.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

<?php
  if($succes){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong>You are successfully signed up.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>
    <h1 class="text-center mt-5">Sign Up Page</h1>
    <div class="container mt-5">
  <form action="sign.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">username</label>
    <input type="text" class="form-control" placeholder="Enter your name" name="username" autocomplete="off" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">password</label>
    <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off" required>
  </div>

  <button type="submit" class="btn btn-primary w-100">Sign up</button>
</form>
</div>


    
  </body>
</html>