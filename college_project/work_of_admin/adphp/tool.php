<?php
include "../price_detail/conn.php";

if (isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name']; 
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = '../../tools_image/' . $file_name; // Path to store the image
    
    $name = $_POST['name']; 
    $price = $_POST['price']; // Get the price
    $description = $_POST['des1'];
    $quantity = $_POST['quantity'];

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO tool_tb (name, image, price, description, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $name, $file_name, $price, $description, $quantity);
    
    if ($stmt->execute()) {
        // Move the uploaded file to the folder
        if (move_uploaded_file($tmp_name, $folder)) {
            echo "
            <script>
                alert('Insert successful!');
                window.location.href = 'toolsDisplay.php';
            </script>";
        } else {
            echo "Error: Could not move the file to the folder. Check folder permissions.";
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
?>
