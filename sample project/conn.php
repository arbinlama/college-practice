<?php
$servername= "localhost";
$username= "root";
$password = "";
$db = "mydatabase";
$conn= new mysqli($servername, $username, $password, $db);
if($conn->connect_error){
    die("fail to connect". $conn->connect_error);
}
echo("connect successfully");
?>
