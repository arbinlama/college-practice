<?php
include "conn.php";

if (isset($_POST['submit'])) {
    $userType = $_POST['user_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_user = "SELECT * FROM user_tb WHERE username = '$username'";
    $result_user = $conn->query($sql_user);

    // Check if the username already exists in admin_tb
    $sql_admin = "SELECT * FROM admin_tb WHERE username = '$username'";
    $result_admin = $conn->query($sql_admin);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

    // Check user type and construct the SQL query accordingly
    if ($userType == 'user') {
        // Insert into user_tb
        if ($result_user->num_rows > 0) {
            echo "<script>
                alert('Username already exists in user registration. Please choose another username.');
                window.location.href = '../register/reg.php'; // Redirect back to the registration page
            </script>";
            exit();
        }else {
        $sql = "INSERT INTO user_tb (username, password, user_type) VALUES ('$username', '$hashedPassword', '$userType')";
        }
    } elseif ($userType == 'admin') {
        
        if ($result_admin->num_rows > 0) {
            // User exists in admin_tb, so don't allow them to register as admin again
            echo "<script>
                alert('Username already exists as an admin. Please choose another username.');
                window.location.href = '../register/reg.php'; // Redirect back to the registration page
            </script>";
            exit();
        }else {
       
        $sql = "INSERT INTO admin_tb (username, password, user_type) VALUES ('$username', '$hashedPassword', '$userType')";
        }
    } else {
        echo "Invalid user type";
        exit;
    }

    // Execute the SQL query for inserting the user
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Registration successful!');
            window.location.href = '../loginpage/login.php'; // Redirect to login page after successful registration
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
