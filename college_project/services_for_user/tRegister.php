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
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
            <input type="text" name="tname" id="tname" placeholder="Enter the training name" required>
            <h3>Your Contact Details</h3>
            
            <h4>Your Name</h4>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="you@example.com" required>
            
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" placeholder="First Name" required>
            
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" placeholder="Last Name" required>
            
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" placeholder="e.g., +123456789" required>
            
            <label for="country">Your Country Name:</label>
            <input type="text" name="country" id="country" placeholder="Country" required>
            
            <label for="zip">Your ZIP Code:</label>
            <input type="text" name="zip" id="zip" placeholder="ZIP Code" required>
            
            <input type="submit" value="Submit" name="submit">
        </div>
    </form>
    <?php 

    include "../php/conn.php";

    if(isset($_POST['submit'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        $training_name = $_POST['tname'];

        $sql = "insert into training_register_tb(first_name, last_name, phone, country, zip, training_name, email) 
        values 
        ('$fname', '$lname', '$phone', '$country', '$zip', '$training_name', '$email')";

        $result = $conn->query($sql);

        if($result === true) {
            echo"
            <script>
            alert ('You register successfully');
              window.location.href = '../training.php';
            </script>";
        }else {
            echo 'database error: ' . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
