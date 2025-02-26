<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../loginpage/login.php");
    exit();
}

// Check passcode submission
if (isset($_POST['submit'])) {
    $entered_pass = $_POST['pass'];
    $correct_pass = $_SESSION['pass_code'];

    if ($entered_pass == $correct_pass) {
        // Clear pass_code from session and redirect to admin dashboard
        unset($_SESSION['pass_code']);
        echo "<script>
                alert('Register successfully !');
                window.location.href = '../loginpage/login.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Invalid pass code !');
                window.location.href = '../register/reg.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Passcode</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="submit"] {
            width: 250px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            display: block;
            margin: 10px auto;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Admin Passcode</h2>
        <form method="POST" action="">
            <label for="pass">Passcode</label>
            <input type="text" name="pass" required>
            <input type="submit" name="submit" value="Enter">
        </form>
    </div>
</body>
</html>
