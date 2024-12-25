<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "agrihubdb";

$conn= new mysqli($servername, $username, $password, $db);

if($conn->connect_error) {
    die("faild to connect data base.");
}
echo ("connect successfully.");
?>