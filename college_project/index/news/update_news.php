<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News update</title>
    <style>
        /* Apply some basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        input[type="submit"], a {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: fit-content;
            font-size: 16px;
            text-decoration: none;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: red;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<?php 
    include "conn.php";

    // Handle update form submission
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $detail = $_POST['detail'];
        $date = $_POST['date'];

        // Escaping values to prevent SQL injection
        $id = $conn->real_escape_string($id);
        $detail = $conn->real_escape_string($detail);
        $date = $conn->real_escape_string($date);

        // SQL Update Query
        $sql = "UPDATE news_tb SET detail = '$detail', date = '$date' WHERE id = '$id'";

        $result = $conn->query($sql);

        if ($result === true) {
            echo "<script>
                alert('Record updated successfully');
                window.location.href = 'display_news.php';
            </script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Fetch record based on ID from URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // SQL Query to Fetch Record by ID
        $sql = "SELECT * FROM news_tb WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Ensure the date is in the correct format for the date input field
            $date = $row['date'];
            $formatted_date = date('Y-m-d', strtotime($date)); // Format the date as YYYY-MM-DD

?>
            <!-- Update Form -->
            <form action="" method="post" onsubmit="return validateDate()">
                <h2>Update News Information</h2>
                <fieldset>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <label for="detail">News Detail: </label>
                    <textarea name="detail" id="detail" required><?php echo htmlspecialchars($row['detail']); ?></textarea>

                    <label for="date">News Date: </label>
                    <input type="date" name="date" value="<?php echo $formatted_date; ?>" required>

                    <input type="submit" name="update" value="Update">
                    <a href="display_news.php">Back</a>
                </fieldset>
            </form>

            <script>
                function validateDate() {
                    var inputDate = document.querySelector('input[name="date"]').value;
                    var currentDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

                    // If the entered date is less than today's date, show an alert and return false to prevent form submission
                    if (inputDate < currentDate) {
                        alert("The date cannot be in the past.");
                        return false;
                    }

                    return true; // Allow form submission if the date is valid
                }
            </script>

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
