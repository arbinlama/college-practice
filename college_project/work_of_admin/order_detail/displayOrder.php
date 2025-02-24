<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
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
    </style>
</head>
<body>

    <div class="tbl">
        <table class="table">
            <thead>
                <tr>
                    <th>Order_id</th>
                    <th>Tool_id</th>
                    <th>User_id</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Order Date</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['tool_id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['total_price']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['order_date']}</td>
                                <td>
                                   <a href='../work_of_admin/order_detail/orderUpdate.php?id={$row['order_id']}'>Update</a>
                                   <a href='../work_of_admin/orders_detail/orderDelete.php?id={$row['order_id']}'>Delete</a>
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
