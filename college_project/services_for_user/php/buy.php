<?php
session_start(); // Start session
include "conn.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to make a purchase.</p>";
    exit;
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID

// Fetch user information from database
$user_sql = "SELECT * FROM user_tb WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_sql);

if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user = mysqli_fetch_assoc($user_result);
} else {
    echo "<p>User information not found.</p>";
    exit;
}

// Check if 'id' parameter exists in URL
if (isset($_GET['id'])) {
    $tool_id = $_GET['id'];

    // Fetch tool details from the database
    $tool_sql = "SELECT * FROM tool_tb WHERE id = $tool_id";
    $tool_result = mysqli_query($conn, $tool_sql);

    if (mysqli_num_rows($tool_result) > 0) {
        $tool = mysqli_fetch_assoc($tool_result);
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
            box-shadow: none;
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
            <p>Price: &#8360; <?php echo $tool['price']; ?></p>

            <!-- Purchase Form -->
            <form action="process_buy.php" method="POST" class="form-container" onsubmit="return validateForm()">
                <input type="hidden" name="tool_id" value="<?php echo $tool['id']; ?>">
                <input type="hidden" name="price" value="<?php echo $tool['price']; ?>">

                <!-- Quantity Input -->
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" min="1" value="1" required>

                <!-- Prefilled User Information -->
                <label for="name">Full Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                <label for='user_id'>User_id:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['id']); ?>" readonly>


                <label for="contact">Contact Number:</label>
                <input type="text" name="contact"  required>

                <label for="address">Shipping Address:</label>
                <textarea name="address" rows="4" required></textarea>

                <!-- Submit Button -->
                <button type="submit">Place Order</button>
            </form>

            <!-- JavaScript Validation -->
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
