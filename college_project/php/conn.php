<?php 
$servername= "localhost";
$username="root";
$password= "";
$db= "agrihubdb";
$conn = new mysqli($servername, $username, $password, $db);
if($conn->connect_error){
    die ("Fail to connect". $conn->connect_error);
}
echo ("connect successfully");
?>

