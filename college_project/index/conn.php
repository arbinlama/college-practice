<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "agrihubdb";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Failed to connect to database.");
}
?>
