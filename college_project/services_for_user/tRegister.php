<?php 
    session_start();
    include "../php/conn.php";

    // Check if the 'id' parameter exists in the URL
    if (isset($_GET['id'])) {
        $training_id = htmlspecialchars($_GET['id']);

        // Fetch training details from the database using the training_id
        $sql = "SELECT * FROM training_tb WHERE id = '$training_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $training_name = $row['heading'];  // You can fetch the appropriate field here
        } else {
            echo "<script>alert('Training not found!');</script>";
            exit;
        }
    } else {
        // If there's no 'id' in the URL, you can redirect the user or show an error
        echo "<script>alert('Invalid access!'); window.location.href = 'training.php';</script>";
        exit;
    }

    // Retrieve user data from the user_tb if a user is logged in (assuming you have a session with user info)
    if (isset($_SESSION['user_id'])) { 
        $user_id = $_SESSION['user_id']; // Assuming 'user_id' is stored in the session
        
        // Fetch user data from the 'user_tb' table
        $user_sql = "SELECT * FROM user_tb WHERE id = '$user_id'";
        $user_result = $conn->query($user_sql);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_name = $user_row['username'];
        } else {
            echo "<script>alert('User not found!');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please log in to register.'); window.location.href = '../loginpage/login.php';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
       body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            opacity: 90%;
        }
        .para {
            margin-top: 10px;
            font-size: 15px;
        }
        h1, h2 {
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .buttn {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .buttn input {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            width: fit-content;
        }
        .submit-btn {
            background-color: #4caf50;
            color: white;
        }
        .back-btn {
            background-color: black;
            color: white;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .back-btn:hover {
            background-color: #bbb;
        }
        p {
            font-size: 14px;
            line-height: 1.5;
            color: #666;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h1>Register for a New Entry Program</h1>
            <p class='para'>
                Complete the following form to register for the program of your choice. 
                You'll receive a confirmation by email — be sure to check your spam folder if you don't see anything. 
                If you still don't receive a confirmation within two hours of registering,
                drop us an email at <strong>agrihub@gmail.com</strong> or call us at <strong>+0178-654-6745</strong>.
            </p>
            
            <label for="tname">Training Name:</label>
            <input type="text" name="tname" id="tname" value="<?php echo $training_name; ?>"  readonly>

            <h3>Your Contact Details</h3>
            <h4>Your Name</h4>
            
            <label for="email">Email:</label>
            <input type="text" name="email" id="email"  placeholder="you@example.com" required>
            
            <label for="fname">Name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo $user_name; ?>" placeholder="First Name" readonly>
            
            
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" placeholder="e.g., 98XXXXXXXX" required>
            
            <label for="country">Your Country Name:</label>
            <input type="text" name="country" id="country" placeholder="Country" required>
            
            <label for="zip">Your ZIP Code:</label>
            <input type="text" name="zip" id="zip" placeholder="ZIP Code" required>

            <div class="buttn">
                <input type="submit" class="submit-btn" value="Submit" name="submit">
                <button type="button" class="back-btn" onclick="window.history.back();">Back</button>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        $training_name = $_POST['tname'];

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.');</script>";
            exit;
        }

        // Phone number validation (basic example)
        if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
            echo "<script>alert('Invalid phone number format.');</script>";
            exit;
        }

        $sql = "INSERT INTO training_register_tb(first_name, last_name, phone, country, zip, training_name, email) 
                VALUES ('$fname', '$lname', '$phone', '$country', '$zip', '$training_name', '$email')";

        $result = $conn->query($sql);

        if ($result === true) {
            echo "<script>alert('You registered successfully'); window.location.href = 'training.php';</script>";
        } else {
            echo 'Database error: ' . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
