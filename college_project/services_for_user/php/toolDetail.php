<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tools details</title>
    <link rel="icon" href="../../image/ficon.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;  
            background-color: #ddd;
            margin: 0;
            padding: 20px;
        }

        .tbl {
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 80%;
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
            margin-right: 10px;
        }

        .back:hover {
            background-color: red;
            transform: scale(1.3);
        }

       
        .top {
            display: flex;
            justify-content: center; 
            width: 100%;
            align-items: center;
            margin-bottom: 20px;
        }

        .top h1 {
            margin: 0;  
        }

    </style>
</head>
<body>
    <div class="top">
        <a class="back" href="../../userindex/userdashboard.html">Back</a>
        <h1>Tools Details</h1>
    </div>
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
