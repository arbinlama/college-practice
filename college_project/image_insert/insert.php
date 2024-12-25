<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="icon" href="../image/ficon.png" type="image/x-icon">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            margin-top: 50px;
            font-family: Arial, sans-serif;
        }
        form {
            border: 1px solid black;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="file"] {
            font-size: 16px;
            margin-bottom: 20px;
        }
        button, a {
            border: 1px solid black;
            background: green;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
        }
        button:hover, a:hover {
            background-color: lightyellow;
            color: black;
        }
    </style>
</head>
<body>
    <?php 
    include "conn.php";

    if (isset($_POST['submit'])) {
        $file_name = basename($_FILES['image']['name']);
        $temp_name = $_FILES['image']['tmp_name']; // Use 'tmp_name' for temporary file location
        $folder = '../database_image/' . $file_name;

        // Validate file type (allow only images)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_types)) {
            // Insert file name into the database
            $query = mysqli_query($conn, "INSERT INTO image_tb (name) VALUES ('$file_name')");
            
            if ($query && move_uploaded_file($temp_name, $folder)) {
                echo "<p style='color: green;'>File uploaded successfully</p>";
            } else {
                echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
        }
    }
    ?>
    
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h1>Insert Image</h1>
        <input type="file" name="image" required>
        <br>
        <button type="submit" name="submit">Submit</button>
        <a href="view.php">View Data</a>
        <a href="../adminindex/admindashboard.html">Back</a>
    </form>
</body>
</html>
