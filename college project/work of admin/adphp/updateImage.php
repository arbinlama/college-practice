<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tool</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #d1d1d1;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <?php
    include "../price detail/conn.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

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
        $sql = "UPDATE tool_tb SET name = '$name', image = '$image', description = '$description' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Record updated successfully');
            window.location.href = 'toolsDisplay.php';
            </script>";
        } else {
            echo "<p style='color: red;'>Error updating data: " . $conn->error . "</p>";
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
            $description = $row['description'];
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Update Tool</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="existing_image" value="<?php echo $image; ?>">

                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>

                <label for="image">Image</label>
                <input type="file" name="image">
                <?php if (!empty($image)) { ?>
                    <p>Current Image:</p>
                    <img src="../../tools_image/<?php echo $image; ?>" alt="Tool Image">
                <?php } ?>

                <label for="description">Description</label>
                <input type="text" name="description" value="<?php echo $description; ?>" required>

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
