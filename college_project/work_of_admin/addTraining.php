<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../image/ficon.png" type="image/x-icon">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;
            background-color: green;
            justify-content: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
       
        form {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            background-color: #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        input[type="submit"], button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 10px;
            text-decoration: none;
        }
         a {
            color: #fff;
            text-decoration: none;
        } 
        input[type='submit']:hover,
        button:hover {
            background-color: red;
            transform: scale(1.2);
            margin: 10px;
            
        }
       
      
    </style>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <h1>Insert  Training Details</h1>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" class="image">

    <label for="heading">Heading:</label>
    <input type="text" name="heading" id="heading" required>

    <label for="sub_heading">Sub-heading:</label>
    <input type="text" name="sub_heading" id="sub_heading" required>

    <label for="exp">Description:</label>
    <input type="text" name="exp" id="exp" required>

    <label for="diff">Types of Training:</label>
    <input type="text" name="diff" id="diff" required>

    <label for="t_description">Type Description:</label>
    <input type="text" name="t_description" id="t_description" required>

    <label for="class_duration">Class Duration:</label>
    <input type="text" name="class_duration" id="class_duration" required>

    <label for="class_time">Class Time:</label>
    <input type="text" name="class_time" id="class_time" required>

    <label for="training_schedule">Training Schedule:</label>
    <input type="text" name="training_schedule" id="training_schedule" required>

    <input type="submit" value="Submit" name="submit">

    <button type="button" class="back">
            <a href="../adminindex/admindashboard.html">Back</a>
        </button>

</form>

    <?php 
  include "price_detail/conn.php";

if (isset($_POST['submit'])) {
    // Get form inputs and escape special characters
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $sub_heading = mysqli_real_escape_string($conn, $_POST['sub_heading']);
    $exp = mysqli_real_escape_string($conn, $_POST['exp']);
    $diff = mysqli_real_escape_string($conn, $_POST['diff']);
    $t_description = mysqli_real_escape_string($conn, $_POST['t_description']);
    $class_duration = mysqli_real_escape_string($conn, $_POST['class_duration']);
    $class_time = mysqli_real_escape_string($conn, $_POST['class_time']);
    $training_schedule = mysqli_real_escape_string($conn, $_POST['training_schedule']);
    
    // File upload handling
    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $folder = '../training_image/' . $file_name;


    // Move the file to the desired folder
    if (move_uploaded_file($temp_name, $folder)) {
        // Insert data into the database
        $query = "INSERT INTO training_tb (heading, sub_heading, exp1, diff, t_description, class_duration, class_time, training_schedule, image) 
                VALUES ('$heading', '$sub_heading', '$exp', '$diff', '$t_description', '$class_duration', '$class_time', '$training_schedule', '$file_name')";

        if (mysqli_query($conn, $query)) {
            echo "
            <script>
            alert('Record inserted successfully');
            window.location.href='displayTraining.php'; 
            </script>";
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload the file.";
    }
}
?>


</body>
</html>