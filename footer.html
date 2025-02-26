<?php 
include "../image_insert/conn.php"; 

// Fetch image path from database
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
    <title>Registration Form</title>
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

        /* Centering the form */
        .wrapper {
            width: 350px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-box {
            position: relative;
            margin: 10px 0;
        }

        .input-box input, .input-box select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            background: #007BFF;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background: red;
            border-radius: 10px;
        }

        .cross {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="loginform">
        <span class="cross">
            <i class="bx bx-x"></i>
        </span>
        <form action="../php/registerdata.php" method="post" onsubmit="return validatePassword()">
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" placeholder="User name" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" placeholder="Password" name="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <div class="input-box">
                <label for="text">Register As:</label>
                <select name="user_type" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
        </form>
    </div>

    <script>
        // JavaScript to redirect to the login page when the cross button is clicked
        document.querySelector('.cross').addEventListener('click', () => {
            window.location.href = '../loginpage/login.php';
        });

        // Password validation function
       function validatePassword() {
       const password = document.getElementById('password').value; // Get the password input
       const pattern1 = /[\W]/; // Regex to check for special characters

       // Check if the password is valid
       if (password.length < 8) {
           alert('Password must be at least 8 characters long.');
              return false; // Prevents form submission
       }

       // Check if the password contains at least one special character
       if (!pattern1.test(password)) {
           alert('Password must contain at least one special character.');
           return false; // Prevents form submission
       }
       return true; // Allows form submission
      }

    </script>
</body>
</html>
