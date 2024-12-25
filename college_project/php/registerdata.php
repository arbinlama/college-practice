<?php
include "conn.php";

if (isset($_POST['submit'])) {
    $userType = $_POST['user_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

    if($userType == 'user') {
        $sql = "INSERT INTO user_tb (username, password, user_type) VALUES (?, ?, ?)";
    } elseif ($userType == 'admin') {
        $sql = "INSERT INTO admin_tb (username, password, user_type) VALUES (?, ?, ?)";
    } else {

        // Handle invalid user type

        echo "Invalid user type";
        exit;
    }

    // Prepare and execute the SQL statement
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashedPassword, $userType);

    if ($stmt->execute()) {
        echo "<script>
            alert('Registration successful!');
            window.location.href = '../loginpage/login.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}