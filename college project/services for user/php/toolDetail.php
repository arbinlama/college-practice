<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-spacing: 0;
            ;
        }
        img {
            max-width: 100px;
            max-width: 100px;
        }
    </style>
</head>
<body>
    <h2>This is a section of tools</h2>
    <table>
        <a href="../../userindex/userdashboard.html">Back</a>
        
        <tr>
            <th>S.N</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Discription</th>
        </tr>
    <?php
    include "../../work of admin/price detail/conn.php";
    $sql = "select *from tool_tb";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        $sn = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$sn}</td>
            <td><img src='../../tools_image/{$row['image']}' alt='loading image'></td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            </tr>
            ";
            $sn++;
        }
    }else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
    ?>
    </table>
</body>
</html>