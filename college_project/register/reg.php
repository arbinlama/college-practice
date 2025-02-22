<?php 
include "../image_insert/conn.php"; 
$sql = "SELECT * FROM image_tb WHERE id = 2"; 
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
    <title>Registration form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="reg.css">
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
        <form action="../php/registerdata.php" method="post">
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" placeholder="User name" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <div class="input-box">
                <label for="text">Register As:</label>
                <select name="user_type" required >
                    <option value="user" >User</option>
                    <option value="admin" >Admin</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
            
        </form>
    </div>
    <script>
        // JavaScript to redirect to the index page when the cross button is clicked
        const crossButton = document.querySelector('.cross');
    
        crossButton.addEventListener('click', () => {
            // Redirect to the index page (assuming 'index.html' is the home page)
            window.location.href = '../loginpage/login.php';
        });
    </script>
</body>
</html>