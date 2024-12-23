<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <style>
        .tbl {
            width: 90%;
            margin: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #c2c2c2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #e6f7ff;
        }
    </style>
</head>
<body>
    <div class="tbl">
        <h2>Daily Price List - <span id="current"></span></h2>
       
        <button type="submit">
        <a href="http://localhost/college practice/college project/adminindex/admindashboard.html">Home</a>

        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM price_tb";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['unit']}</td>
                                <td>{$row['minimum']}</td>
                                <td>{$row['maximum']}</td>
                                <td>{$row['average']}</td>
                                <td>
                                   <a href='priceUpdate.php?id={$row['id']}'>Update</a>
                                   <a href='recordDelete.php?id={$row['id']}'>Delete</a>
                                   <a href=index.html?id={$row['id']}'>Insert</a>
                                </td>
                              </tr>";
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
