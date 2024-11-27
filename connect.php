<?php
$host='localhost';
$username='root';
$password='admin';
$dbname='signupforms';

$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $con = new PDO($dsn, $username, $password);

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection successful!";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>