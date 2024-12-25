<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        .home {
            border: 1px solid black;
            text-decoration: none;
            background-color: green;
            color: white;
            font-size: 25px;
            padding: 5px 10px;
            display: inline-block;
            position: sticky;
        }
        .home:hover {
            background: red;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <h2>This is a section of tools view</h2>
    <table>
        <a href="../../adminindex/admindashboard.html" class="home">Back</a>
        <tr>
            <th>S.N</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Description</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        include "../../work_of_admin/price_detail/conn.php";
        $sql = "SELECT * FROM tool_tb";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $sn = 1;
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$sn}</td>
                    <td><img src='../../tools_image/" . htmlspecialchars($row['image']) . "' alt='loading image'></td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['description']) . "</td>
                    <td>
                        <a href='updateImage.php?id=" . htmlspecialchars($row['id']) . "'>Update</a>
                        <a href='deleteImage.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a>
                    </td>
                </tr>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
