<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tool</title>
    <style>
        body {
            font-family: 'Arial', Helvetica, sans-serif;
            background-color: #f4f4f9;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        form {
            width: 30%;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        img {
            max-width: 150px;
            height: auto;
            margin-top: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    include "conn.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        // Handle file upload
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = '../../tools_image/' . $image;

        if (!empty($image)) {
            move_uploaded_file($tmp_name, $folder); 
        } else {
            $image = $_POST['existing_image'];
        }

        // Direct SQL query
        $sql = "UPDATE tool_tb SET name = '$name', image = '$image', price = '$price' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Record updated successfully');
            window.location.href = 'toolsDisplay.php';
            </script>";
        } else {
            echo "<p class='alert'>Error updating data: " . $conn->error . "</p>";
        }
    }

    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        $sql = "SELECT * FROM tool_tb WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $image = $row['image'];
            $price = $row['price'];
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Update Tool</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="existing_image" value="<?php echo $image; ?>">

                <label for="name">Tool Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>

                <label for="image">Tool Image</label>
                <input type="file" name="image">
                <?php if (!empty($image)) { ?>
                    <p>Current Image:</p>
                    <img src="../../tools_image/<?php echo $image; ?>" alt="Tool Image">
                <?php } ?>

                <label for="price">Price</label>
                <input type="text" name="price" value="<?php echo $price; ?>" required>

                <button type="submit" name="update">Update</button>
            </form>
            <?php
        } else {
            echo "<script>
            alert('No record found!');
            window.location.href = 'toolsDisplay.php';
            </script>";
        }
    } else {
        header('location:toolsDisplay.php');
    }
    ?>
</body>
</html>
