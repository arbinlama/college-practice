<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image of Database</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0; 
            margin: 0;
            font-family: Arial, sans-serif;
        }
        h2 {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            background-color: green;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        img {
            max-width: 200px;
            max-height: 200px;
        }
        thead {
            background-color: #f2f2f2;
        }
        a:hover {
            background-color: blue;
            color: red;
            border-radius: 30%;
        }
    </style>
</head>
<body>
    <h2>Image of Database</h2>
    <a href="insert.php">Back</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include "conn.php";

        $sql = "SELECT * FROM image_tb";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td><img src='../database_image/" . htmlspecialchars($row['name']) . "' alt='Image'></td>
                </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='2'>No images found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</body>
</html>
