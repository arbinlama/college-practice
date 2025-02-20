<?php
include "conn.php";

// Check if the 'id' parameter is in the URL
if (isset($_GET['id'])) {
    $tool_id = $_GET['id'];

    // Fetch the tool details from the database
    $sql = "SELECT * FROM tool_tb WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tool_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tool = $result->fetch_assoc();
    } else {
        echo "<p>Tool not found.</p>";
        exit;
    }
} else {
    echo "<p>Tool not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Tool</title>
    <link rel="icon" href="../../image/ficon.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 800px;
            display: flex;
            flex-direction: row;
            gap: 20px;
            box-shadow: none; /* Removed box-shadow */
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .image-container {
            flex: 1;
            text-align: center;
        }

        .details-container {
            flex: 2;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 18px;
            color: #333;
        }

        input[type="number"], input[type="text"], input[type="email"], textarea {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-size: 18px;
        }

        .back-link:hover {
            color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="../../tools_image/<?php echo $tool['image']; ?>" alt="Tool Image">
        </div>
        <div class="details-container">
            <a href="toolDetail.php" class="back-link">← Back to Tools</a>
            <h1>Purchase Tool</h1>
            <h2><?php echo $tool['name']; ?></h2>
            <p>Price: $<?php echo $tool['price']; ?></p>

            <!-- Purchase Form -->
           <!-- Purchase Form -->
<form action="process_buy.php" method="POST" class="form-container" onsubmit="return validateForm()">
    <input type="hidden" name="tool_id" value="<?php echo $tool['id']; ?>">
    <input type="hidden" name="price" value="<?php echo $tool['price']; ?>">

    <!-- Quantity Input -->
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required>

    <!-- User Information (optional) -->
    <label for="name">Full Name:</label>
    <input type="text" name="name" placeholder="Enter your full name" required>
    
        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" placeholder="Enter your contact number" required>

    <label for="address">Shipping Address:</label>
    <textarea name="address" rows="4" placeholder="Enter your shipping address" required></textarea>

    <!-- Submit Button -->
    <button type="submit">Place Order</button>
</form>

<!-- JavaScript Validation Function -->
<script>
    function validateForm() {
        const contactInput = document.querySelector('input[name="contact"]');
        const contactValue = contactInput.value.trim();

        // Regular expression for validating the contact number
        const contactPattern = /^98\d{8}$/;

        if (!contactPattern.test(contactValue)) {
            alert('Please enter a valid contact number that starts with "98" and contains 10 digits.');
            contactInput.focus();
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
 </script>

        </div>
    </div>
</body>
</html>
