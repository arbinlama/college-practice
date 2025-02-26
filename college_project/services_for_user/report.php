<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Report</title>
    <link rel="icon" href="../image/ficon.png" type="image/x-icon">
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .tbl {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #333;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .action-btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #45a049;
        }
        .back {
            text-decoration: none;
            background: green;
            color: #fff;
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .back:hover {
            background-color: red;
            transform: scale(1.2);
        }
        .top {
            display: flex;
            justify-content: center; 
            align-items: center;
            gap: 20px;
            margin-bottom: 10px;
        }
        .top .head {
            font-size: 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <p class="head">Training Report</p>
            <a class="back" href="../userindex/userdashboard.php">Back</a>
        </div>
        <table class="tbl">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>ZIP</th>
                    <th>Training Name</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include "php/conn.php";
                $sql = "SELECT * FROM training_register_tb";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $sn = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$sn}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['country']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['zip']}</td>
                            <td>{$row['training_name']}</td>
                           
                        </tr>";
                        $sn++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
