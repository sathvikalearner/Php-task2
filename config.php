<?php
$host = 'localhost';
$user = 'root';
$pass = 'mysql';
$db = 'crud_app';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
