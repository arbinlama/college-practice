<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "conn.php" ?>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="address">Address:</label>
        <input type="text" name="address">
        <br><br>
        <label for="email">Email:</label>
        <input type="text" name="email">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="age" >Age:</label>
        <input type="number" name="age">
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $address= $_POST['address'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $sql = "insert into student_tb(stu_name, address, email, age) values('$name', '$address', '$email', '$age')";
        $result = $conn->query($sql);
        if($result == true){
            echo("create the new record successfully");
        }else{
            echo ("error to create the record");
        }
        $conn->close();
    }
    ?>
</body>
</html>