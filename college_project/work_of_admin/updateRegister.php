<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Registration Table</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
        }
        form {
            width: 60%; /* Adjust width for better layout */
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #333;
            border-radius: 5px; /* Add border-radius for rounded corners */
            background-color: #fff;
        }
        fieldset {
            border: none;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: fit-content;
        }
        input[type="submit"]:hover {
            background-color: gold;
        }
        a {
            display: inline-block;
            text-align: center;
            width: 100%;
            padding: 10px;
            background-color: yellow;
            color: black;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
            width: fit-content;
        }
        a:hover {
            background-color: gold;
        }
    </style>
</head>
<body>
    <?php 
        include "price_detail/conn.php";

        // Handle update form submission
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $phone = $_POST['phone'];
            $country = $_POST['country'];
            $zip = $_POST['zip'];
            $email = $_POST['email'];
            $training_name = $_POST['training_name'];

            $sql = "UPDATE training_register_tb 
                    SET first_name = '$fname', 
                        phone = '$phone', 
                        country = '$country',
                        zip = '$zip', 
                        training_name = '$training_name', 
                        email = '$email' 
                    WHERE id = '$id'";

            $result = $conn->query($sql);

            if ($result === true) {
                echo "<script>
                alert('Record updated successfully');
                window.location.href = 'displayTrainingReg.php';
                </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        // Fetch record based on ID from URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM training_register_tb WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $fname = $row['first_name'];
                $phone = $row['phone'];
                $country = $row['country'];
                $zip = $row['zip'];
                $email = $row['email'];
                $training_name = $row['training_name'];
            ?>
                <form action="" method="post">
                    <h2>User Information Update Form</h2>
                    <fieldset>
                        <input type='hidden' name='id' value="<?php echo $id; ?>">

                        <label for='fname'>First Name</label>
                        <input type="text" name='fname' value="<?php echo $fname; ?>" required>

                        <label for='phone'>Phone</label>
                        <input type="text" name='phone' value="<?php echo $phone; ?>" required>

                        <label for='country'>Country</label>
                        <input type="text" name='country' value="<?php echo $country; ?>" required>

                        <label for='zip'>ZIP</label>
                        <input type="text" name='zip' value="<?php echo $zip; ?>" required>

                        <label for='email'>Email</label>
                        <input type="text" name='email' value="<?php echo $email; ?>" required>

                        <label for='training_name'>Training Name</label>
                        <input type="text" name='training_name' value="<?php echo $training_name; ?>" required>

                        <input type='submit' name='update' value="Update">
                        <a href="displayTrainingReg.php">Back</a>
                    </fieldset>
                </form>
            <?php
            } else {
                echo "Record not found.";
            }
        } else {
            echo "ID not passed in URL.";
        }
    ?>
</body>
</html>
