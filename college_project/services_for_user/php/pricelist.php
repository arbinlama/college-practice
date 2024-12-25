<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="aboutus.css">
    <link rel="icon" href="../../image/ficon.png" type="image/x-icon">
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: "Montserrat", sans-serif;
        }

        .tbl {
            width: 90%;
            margin: 20px auto;
            max-height: 800px;
            overflow-y: auto;
            position: relative;
        }

        .table {
            width: 100%;
            margin-top: 0;
            border-collapse: collapse;
            position: relative;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: pink;
        }

        nav h2 {
            text-align: center;
            justify-content: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #e6f7ff;
        }

        nav {
            display: flex;
            position: sticky;
            top: 0;
            z-index: 1000;
            align-items: center;
            justify-content: center;
            background-color: #c2c2c2;
            height: 7%;
        }

        nav h2 {
            padding-left: 25%;
        }

        nav ul {
            float: right;
            margin-right: 100px;
            padding-left: 25%;
        }

        nav ul a {
            display: inline-block;
            line-height: 60px;
            margin: 0 5px;
        }

        nav ul a {
            color: black;
            font-size: 20px;
            padding: 7px 13px;
        }

        @media (max-width: 1050px) {
            nav h2 {
                text-align: center;
                padding-left: 0;
                font-size: 16px;
            }

            nav ul {
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            nav ul a {
                font-size: 16px;
                padding-left: 5%;
            }

            nav ul a {
                margin: 5px;
            }

            .table,
            thead,
            tbody {
                width: 100%;
            }

            nav ul a {
                font-size: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 10px;
                color: black;
            }

            nav ul a i {
                margin-right: 5px;
            }
        }

        ul a:hover {
            color: red;
            transform: scale(1.5);
        }

        @media (max-width: 1050px) {
            nav h2 {
                text-align: center;
                padding-left: 0;
                font-size: 16px;
            }

            nav ul {
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            nav ul a {
                font-size: 16px;
                padding-left: 5%;
            }

            nav ul a {
                margin: 5px;
            }

            .table,
            thead,
            tbody {
                width: 100%;
            }

            nav ul a {
                font-size: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 10px;
                color: black;
            }

            nav ul a i {
                margin-right: 5px;
            }
        }

        ul a:hover {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <h2>Daily Price List - <span id="current"></span></h2>
        <ul>
            <a href="../../userindex/userdashboard.html"><i class="fa fa-home"></i></a>
        </ul>
    </nav>
    <div class="tbl">
        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM price_tb";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $sn = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['unit']}</td>
                                <td>{$row['minimum']}</td>
                                <td>{$row['maximum']}</td>
                                <td>{$row['average']}</td>
                                </tr>";
                        $sn++;
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('current').textContent = formattedDate;
    </script>
</body>

</html>