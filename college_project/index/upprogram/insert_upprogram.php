<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Apply some basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh; /* Make sure body takes full viewport height */
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: center; /* Center the content vertically */
            background-color: #f4f4f4; /* Light background color */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px; /* Increased form width */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 12px; /* Increased padding for larger fields */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; /* Increased font size */
        }

        textarea {
            height: 150px; /* Increased height for the textarea */
            resize: vertical; /* Allows users to resize the textarea vertically */
        }

        input[type="submit"], button{
            background-color: #4CAF50;
            color: white;
            padding: 12px; /* Increased padding for the submit button */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: fit-content;
            font-size: 16px; /* Increased font size for submit button */
        }

        input[type="submit"]:hover,
        button:hover {
            background-color:red;
            border-radius: 10px;
        }
        a {
            text-decoration: none;
            color: white
        }
        /* Error message style */
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include "conn.php" ?>
    <form action="" method="post">
        <label for="heading">Upcoming training detail</label>
        <textarea name="heading" id="detail" placeholder="Enter the training detail..."></textarea>

        <label for="des">Upcoming training description</label>
        <textarea name="des" id="detail" placeholder="Enter the training description..."></textarea>
        
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
        
        <input type="submit" value="Submit">
        <button><a href="display.php">Back</a></button>
    </form>

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $heading = $_POST['heading'];
        $des = $_POST['des'];
        $date = $_POST['date'];

        // Get the current date
        $currentDate = date('Y-m-d');

        // Validate the date to ensure it is not less than the current date
        if ($date < $currentDate) {
            echo "<p class='error'>Error: The date cannot be in the past.</p>";
        } else {
            // Proceed to insert into database if the date is valid
            $sql = "INSERT INTO upprogram_tb (heading, des, date) VALUES ('$heading', '$des', '$date')";

            $result = $conn->query($sql);

            if($result == true) {
                echo "<script>
                    alert('Create new record successfully');
                </script>";
            } else {
                echo "<script>
                    alert('Error to create new record');
                </script>";
            }
        }
    }
    ?>
</body>
</html>
