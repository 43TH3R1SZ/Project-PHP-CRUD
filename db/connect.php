<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "employeedb";

$dsn = "mysql:host=$host;dbname=$db;chartset = utf8";
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
require_once "./db/controller.php";
require_once "./db/user.php";
$controller = new Controller($pdo);
$user = new user($pdo);

$user -> insertuser("admin","123456789");
?>