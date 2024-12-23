<?php
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
    }
    // Check user table
    elseif ($user_result->num_rows > 0) {
        $row = $user_result->fetch_assoc();
        $hashed_password = $row['password'];
        $user_type = 'user';
    } else {
        echo "<script>
                alert('Invalid username or password!');
                window.location.href = '../loginpage/login.html';
              </script>";
        exit();
    }

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        if($user_type == 'user'){
            echo "<script>
                    alert('Login successful as $user_type!');
                    window.location.href = '../userindex/userdashboard.html';
                  </script>";
            exit();
        }
        else {
            echo "<script>
                    alert('Login successful as $user_type!');
                    window.location.href = '../adminindex/admindashboard.html';
                  </script>";
            exit();
        }
        exit();
    } else {
        echo "<script>
                alert('Invalid username or password!');
                window.location.href = '../loginpage/login.html';
              </script>";
        exit();
    }
}

?>
