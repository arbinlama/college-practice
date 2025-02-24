<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools Details</title>
    <link rel="icon" href="../../image/ficon.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .tool-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center the tool cards */
            align-items: flex-start; /* Align the items at the top */
            gap: 20px;
            width: 100%;
            max-width: 1200px; /* Limit the width of the container */
            margin: 0 auto; /* Center the container */
        }

        .tool-card {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            width: 280px;
            transition: transform 0.3s ease-in-out;
            position: relative;
            text-decoration: none; /* Remove underline for the anchor tag */
        }

        .tool-card:hover {
            transform: scale(1.05);
        }

        .tool-card img {
            max-width: 100%; /* Ensure image is responsive */
            max-height: 250px;
            border-radius: 5px;
            margin-bottom: 15px; /* Adds space between the image and other content */
        }

        .tool-card h3 {
            margin-top: 15px;
            font-size: 20px;
            color: #333;
            position: relative;
        }

        .tool-card h3::before {
            content: "";
            display: block;
            width: calc(100% + 40px); /* Extends the line beyond the card */
            height: 2px;
            background-color: black;
            position: absolute;
            top: -10px;
            left: -20px; /* Aligns the line with the left edge */
        }

        .tool-card p.price {
            font-weight: bold;
            margin-top: 10px;
            font-size: 18px;
            color: #555;
        }

        .back {
            background-color: green;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            margin-bottom: 15px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }

        .back:hover {
            background-color: red;
        }

    </style>
</head>
<body>
    <a class="back" href="../../userindex/userdashboard.html">Back</a>
    <h1>Tools Details</h1>
    <div class="tool-container">
        <?php
        include "conn.php";
        $sql = "SELECT * FROM tool_tb ORDER BY id ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Create a purchase link with the tool id
                $tool_link = "buy.php?id=" . $row['id']; 
                echo "<a href='{$tool_link}' class='tool-card'>
                    <img src='../../tools_image/{$row['image']}' alt='Tool Image'>
                    <h3>{$row['name']}</h3>
                    <p class='price'>&#8360; {$row['price']}</p>
                </a>";
                
            }
        } else {
            echo "<p>No records found</p>";
        }
        ?>
    </div>
</body>
</html>
