<?php 
include "../image_insert/conn.php"; 
$sql = "SELECT * FROM image_tb WHERE id = 39"; 
$result = $conn->query($sql); 
$image_path = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    $image_path = "../database_image/" . $row['name']; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="../image/ficon.png" type="image/x-icon">
    <style>
        body {
            background-image: url('<?php echo $image_path; ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="loginform">
        <span class="cross">
            <i class="bx bx-x"></i>
        </span>
        <form action="../php/login.php" method="POST">
            <h1>Hello</h1>
            <p>Login first to continue.</p>
            <div class="input-box">
                <input type="text" placeholder="User name" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password</a>
            </div>
            <button type="submit" class="btn" name="login">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="../register/reg.php">Register</a></p>
            </div>
        </form>
    </div>
    <script>
        const crossButton = document.querySelector('.cross');
        crossButton.addEventListener('click', () => {
            window.location.href = '../index/index.html';
        });
    </script>
</body>
</html>
