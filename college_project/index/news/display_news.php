<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Details</title>
    <link rel="icon" href="../image/ficon.png" type="image/x-icon">
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
            background-color: #f9f9f9; /* Light background for contrast */
        }
        .tbl {
            width: 90%;
            margin: 20px auto;
            max-height: 800px;
            overflow-y: auto;
            position: relative;
            background: white; /* White background for the table */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .table {
            width: 100%;
            margin-top: 0;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 12px; /* Increased padding for a better look */
            text-align: center;
        }
        .table th {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #ff6b81; /* Changed header color */
            color: white; /* White text for contrast */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px; /* Margin below the title */
            color: #333; /* Darker text color */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #e6f7ff;
        }
        tr:hover {
            background-color: #d1e7fd; /* Light blue on hover */
        }
        @media (max-width: 1050px) {
            h2 {
                font-size: 20px; /* Responsive title font size */
            }
            .table,
            thead,
            tbody {
                width: 100%;
                display: block; /* Ensure proper stacking */
            }
            .table th, .table td {
                display: block; /* Make cells block for mobile */
                width: 100%; /* Full width for mobile */
            }
        }
        .aa a{
            font-size: 20px;
            align-items: center;
            background-color: green;
            color: white;
            padding: 5px;
            margin: 60px;
        }
        #up {
            font-size: 20px;
            align-items: center;
            background-color: green;
            color: white;
            padding: 5px;
        }
        #del {
            font-size: 20px;
            align-items: center;
            background-color: red;
            color: white;
            padding: 5px;
        }
        
       .aa a:hover{
            background-color: red;
            color: black;
            border-radius: 10px;
        }

       #up:hover{
            background-color: red;
            color: black;
            border-radius: 10px;
        }
       #del:hover{
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1>News Detail</h1>
    <div class="tbl">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Detail</th>
                    <th>Date</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <div class="aa">
                    <a href='insert_news.php'>Insert</a>
                </div>
                <?php
                $sql = "SELECT * FROM news_tb";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['title']}</td>
                                <td>{$row['detail']}</td>
                                <td>{$row['date']}</td>
                                <td>
                                   <a id='up' href='update_news.php?id={$row['id']}'>Update</a>
                                   <a id='del' href='delete_news.php?id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
