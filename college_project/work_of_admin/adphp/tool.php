<?php
include "../price_detail/conn.php";

if (isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name']; 
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = '../../tools_image/' . $file_name;
    $name = $_POST['name']; 
    $dis = $_POST['description']; // Get the description from the form

    // Check if description is being received correctly
    if (empty($dis)) {
        echo "Description is required.";
        exit;
    }

    // Insert into the database
    $query = mysqli_query($conn, "INSERT INTO tool_tb (name, image, description) VALUES ('$name', '$file_name', '$dis')");

    if ($query) {
        // Move the uploaded file
        if (move_uploaded_file($tmp_name, $folder)) {
            echo "
            <script>
                alert('Insert successful!');
                window.location.href = 'toolsDisplay.php';
            </script>";
        } else {
            echo "Error: Could not move file to folder. Check folder permissions.";
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
?>
