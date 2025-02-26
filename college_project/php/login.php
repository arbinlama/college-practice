<?php
session_start();
include "conn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Search in both admin and user tables
    $admin_sql = "SELECT * FROM admin_tb WHERE username = '$username'";
    $user_sql = "SELECT * FROM user_tb WHERE username = '$username'";

    $admin_result = $conn->query($admin_sql);
    $user_result = $conn->query($user_sql);

    // Check admin table
    if ($admin_result->num_rows > 0) {
        $row = $admin_result->fetch_assoc();
        $hashed_password = $row['password'];
        $user_type = 'admin';
        $passcode = $row['passcode'];  // Assuming the passcode is stored in the admin_tb table
    }
    // Check user table
    elseif ($user_result->num_rows > 0) {
        $row = $user_result->fetch_assoc();
        $hashed_password = $row['password'];
        $user_type = 'user';
        $passcode = null;  // Users don't have a passcode
    } else {
        echo "<script>
                alert('Invalid username or password!');
                window.location.href = '../loginpage/login.php';
              </script>";
        exit();
    }

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Start session
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        
        if ($user_type == 'user') {
            echo "<script>
                    alert('Login successful as $user_type!');
                    window.location.href = '../userindex/userdashboard.php';
                  </script>";
            exit();
        } else {
            // If it's an admin, store the passcode in session
            if ($passcode) {
                $_SESSION['pass_code'] = $passcode;  // Store the passcode in session
                echo "<script>
                        alert('username passwor is correc Please enter your passcode.');
                        window.location.href = 'pass_code.php';  // Redirect to passcode verification page
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('No passcode set for this admin.');
                        window.location.href = '../loginpage/login.php';
                      </script>";
                exit();
            }
        }
    } else {
        echo "<script>
                alert('Invalid username or password!');
                window.location.href = '../loginpage/login.php';
              </script>";
        exit();
    }
}
?>
