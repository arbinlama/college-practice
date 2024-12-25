<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        input[type="submit"], a {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 10px;
        }
       
        input[type="submit"]:hover,
        a:hover {
            background-color: red;
        }
        a {
            text-decoration: none;
        }
      
    </style>
</head>
<body>
    <?php
   include "price_detail/conn.php"; // Include the database connection
if (isset($_POST['update'])) {
    // Capture form data and sanitize
    $id = $_POST['id']; 
    $heading = htmlspecialchars($_POST['heading']);
    $sub_heading = htmlspecialchars($_POST['sub_heading']);
    $exp1 = htmlspecialchars($_POST['exp1']);
    $diff = htmlspecialchars($_POST['diff']);
    $t_description = htmlspecialchars($_POST['t_description']);
    $class_duration = htmlspecialchars($_POST['class_duration']);
    $class_time = htmlspecialchars($_POST['class_time']);
    $training_schedule = htmlspecialchars($_POST['training_schedule']);
    
    // Handling file upload
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = '../training_image/' . $image;
    
    if (!empty($image)) {
        move_uploaded_file($tmp_name, $folder); // Upload new image
    } else {
        $image = $_POST['existing_image']; // Keep existing image if no new image uploaded
    }
    
    // Update the database
    $sql = "UPDATE training_tb SET heading = '$heading', sub_heading = '$sub_heading', exp1 = '$exp1', 
            diff = '$diff', t_description = '$t_description', class_duration = '$class_duration',
            class_time = '$class_time', training_schedule = '$training_schedule', image = '$image'
            WHERE id = '$id'"; 

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Record updated successfully');
    window.location.href = 'displayTraining.php';
    </script>"; 
} else {
    echo "<p style='color: red;'>Error updating data: " . $conn->error . "</p>";
}
}

// Retrieve data for the form if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM training_tb WHERE id = '$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the record
        
        ?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <input type="hidden" name="existing_image" value="<?php echo $row['image']; ?>" />
    
    <label for="image">Image</label>
    <input type="file" name="image">
    <?php if (!empty($row['image'])) { ?>
        <p>Current Image:</p>
        <img src="../training_image/<?php echo $row['image']; ?>" alt="Training image" width="100">
        <?php } ?>
        
        <label for="heading">Heading:</label>
        <input type="text" name="heading" value="<?php echo $row['heading']; ?>" />
        
        <label for="sub_heading">Sub Heading:</label>
        <input type="text" name="sub_heading" value="<?php echo $row['sub_heading']; ?>" />
        
        <label for="exp1">Explanation:</label>
        <input type="text" name="exp1" value="<?php echo $row['exp1']; ?>" />
        
        <label for="diff">Difficulty:</label>
            <input type="text" name="diff" value="<?php echo $row['diff']; ?>" />
            
            <label for="t_description">Description:</label>
            <input type="text" name="t_description" value="<?php echo $row['t_description']; ?>" />
            
            <label for="class_duration">Class Duration:</label>
            <input type="text" name="class_duration" value="<?php echo $row['class_duration']; ?>" />
            
            <label for="class_time">Class Time:</label>
            <input type="text" name="class_time" value="<?php echo $row['class_time']; ?>" />
            
            <label for="training_schedule">Training Schedule:</label>
            <input type="text" name="training_schedule" value="<?php echo $row['training_schedule']; ?>" />
            
            <input type="submit" name="update" value="Update" />
            <a href="displayTraining.php">Back</a>
        </form>
        
        <?php
    } else {
        echo "<script>
        alert('No record found!');
        window.location.href = 'displayTraining.php';
        </script>";
    }
} else {
    header('location:displayTraining.php');
}
?>
</body>
</html>
