<?php
include "conn.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
   
    // Search in both admin and user tables
    $admin_sql = "SELECT * FROM admin_tb WHERE username = ?";
    $user_sql = "SELECT * FROM user_tb WHERE username = ?";

    $stmt_admin = $conn->prepare($admin_sql);
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $admin_result = $stmt_admin->get_result();

    $stmt_user = $conn->prepare($user_sql);
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $user_result = $stmt_user->get_result();

    if ($admin_result->num_rows > 0) {
        // Admin found
        $row = $admin_result->fetch_assoc();
        $hashed_password = $row['password'];
        $pass_code = $row['pass_code']; 
        $user_type = 'admin';
    } elseif ($user_result->num_rows > 0) {
        // User found
        $row = $user_result->fetch_assoc();
        $hashed_password = $row['password'];
        $user_type = 'user';
    } else {
        echo "<script>
                alert('Invalid username or password!');
                window.location.href = '../loginpage/login.php';
              </script>";
        exit();
    }

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $row['username'];  // Fix: Use correct array
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_id'] = $row['id'];  // Fix: Correct user ID variable

        if ($user_type == 'user') {
            echo "<script>
                    alert('Login successful as user!');
                    window.location.href = '../userindex/userdashboard.html';
                  </script>";
            exit();
        } else {
            // Store pass_code in session and redirect admin to passcode entry
            $_SESSION['pass_code'] = $pass_code;
            header("Location: pass_code.php");
            exit();
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
