<?php
// Include the database connection file
include "price_detail/conn.php";

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get training_id from POST data
    $training_id = $_POST['training_id'];

    // Ensure that the training_id is present and valid
    if (isset($training_id) && !empty($training_id)) {
        echo "Training ID: $training_id<br>";  // For debugging

        // Check if the training_id exists in training_tb
        $check_query = "SELECT id FROM training_tb WHERE id = '$training_id'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            echo "Training ID exists in the database.<br>";  // For debugging

            // Retrieve the form data and sanitize it
            $heading = htmlspecialchars($_POST['heading']);
            $sub_heading = htmlspecialchars($_POST['sub_heading']);
            $what = htmlspecialchars($_POST['what']);
            $description = htmlspecialchars($_POST['description']);
            $time_heading = htmlspecialchars($_POST['time_heading']);
            $t_date = htmlspecialchars($_POST['t_date']);
            $t_time = htmlspecialchars($_POST['t_time']);
            $place = htmlspecialchars($_POST['place']);

            // SQL query to insert into training_details
            $sql = "INSERT INTO training_details (training_id, t_heading, t_sub_heading, what_do, description, time_heading, t_date, t_time, place) 
                    VALUES ('$training_id', '$heading', '$sub_heading', '$what', '$description', '$time_heading', '$t_date', '$t_time', '$place')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "Training details added successfully!";
                // Redirect to view training details page with the training_id
                header("Location:displayTraining.php?id=" . $training_id);
                exit;
            } else {
                echo "Error: " . $conn->error;  // Show the actual SQL error
            }
        } else {
            echo "The specified training ID does not exist in the training_tb table.";
        }
    } else {
        echo "Invalid or missing training ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Training Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add Training Details</h2>
        <form action="" method="POST">

            <input type="hidden" name="training_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" id="training_id">

            <label for="heading">Heading:</label>
            <input type="text" name="heading" id="heading" required><br>

            <label for="sub_heading">Sub heading:</label><br>
            <input type="text" name="sub_heading" id="sub_heading" required>

            <label for="what">What to do:</label>
            <input type="text" name="what" id="what" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="time_heading">Time heading:</label><br>
            <input type="text" name="time_heading" id="time_heading" required>

            <label for="t_date">Training date:</label><br>
            <input type="text" name="t_date" id="t_date" required>

            <label for="t_time">Training time:</label><br>
            <input type="text" name="t_time" id="t_time" required>

            <label for="place">Training place:</label><br>
            <input type="text" name="place" id="place" required>

            <input type="submit" value="Add Training Detail">
        </form>
    </div>

</body>
</html>
