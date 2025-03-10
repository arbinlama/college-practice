<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "agrihubdb";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Failed to connect to database.");
}
echo ("Connected successfully.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
            margin: auto;
            max-height: 1000px; /* Set max height */
            overflow-y: auto;  /* Enable vertical scrolling */
        }

        .table {
            width: 100%;
            margin-top: 0;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1); /* Optional: adds a shadow to the sticky header */
        }

        .bar {
            display: flex;
            list-style: none;
            height: 30px;
        }

        .bar ul li {
            background-color: pink;
            float: left;
            padding-left: 6%;
            font-size: 20px;
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

        nav ul li {
            display: inline-block;
            line-height: 60px;
            margin: 0 5px;
        }

        nav ul li a {
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
            nav ul li a {
                font-size: 16px;
                padding-left: 5%;
            }
            nav ul li {
                margin: 5px;
            }
            .table, thead, tbody {
                width: 100%;
            }
            nav ul li a {
                font-size: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 10px;
                color: black;
            }
            nav ul li a i {
                margin-right: 5px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>Daily Price List - <span id="current"></span></h2>
        <ul>
            <li><a href="../adminindex/admindashboard.html"><i class="fa fa-home"></i></a></li>
            <li><a href="../work of admin/price detail/index.html">Insert price</a></li>
        </ul>
    </nav>
    <div class="bar">
        <ul>
            <li>S.N</li>
            <li>Name</li>
            <li>Unit</li>
            <li>Minimum</li>
            <li>Maximum</li>
            <li>Average</li>
            <li colspan="2">Action</li>
        </ul>
    </div>
    <div class="tbl">
        <table class="table">
            <thead>
                <tr>
                    <!-- Table headers will be rendered here -->
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
                                <td>{$row['name']}</td>d
                                <td>{$row['unit']}</td>
                                <td>{$row['minimum']}</td>
                                <td>{$row['maximum']}</td>
                                <td>{$row['average']}</td>
                                <td>
                                   <a href='../work of admin/price detail/priceUpdate.php?id={$row['id']}'>Update</a>
                                   <a href='../work of admin/price detail/recordDelete.php?id={$row['id']}'>Delete</a>
                                </td>
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
