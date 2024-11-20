<?php
$hostname='localhost';
$username='root';
$password='admin';
$database='signupforms';

$con=mysqli_connect($hostname, $username, $password, $database);

if(!$con){
    die(mysqli_error($con));
}

?>