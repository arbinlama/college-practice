<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ddd;
            height: 100vh;
            margin: 0;
        }
        .tbl {
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 15px;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e6f7ff;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .back {
            background-color: green;
            color: #fff;
            font-size: 18px;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .back:hover {
            background-color: #045d04;
        }
    </style>
</head>
<body>
    <h2>This is a section of tools</h2>
    <a class="back" href="../../userindex/userdashboard.html">Back</a>
    <table class="tbl">
        <tr>
            <th>S.N</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php
        include "../../work_of_admin/price_detail/conn.php";
        $sql = "SELECT * FROM tool_tb";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sn = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$sn}</td>
                <td><img src='../../tools_image/{$row['image']}' alt='loading image'></td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                </tr>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
