<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td{
          
            justify-items: center;
            border: 1px solid black;
            border-spacing: 0;
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
                    <td>{$row['id']}</td>
                    <td><img src='../database_image/{$row['name']}' alt='' style='max-width: 200px; max-height: 200px;'></td>
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
