<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details update </title>
</head>
<body>
    <?php
    include "conn.php";
    if(isset($_POST['update'])){
        $order_id = $_POST['order_id'];
        $user_id = $_POST['user_id'];
        $tool_id = $_POST['tool_id'];
        $quantity = $_POST['quantity'];
        $total_price = $_POST['total_price'];
        $order_date = $_POST['order_date'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $sql = "update orders set user_id = '$user_id', tool_id = '$tool_id', quantity = '$quantity', total_price = '$total_price',
         order_date = '$order_date', name = '$name', address = '$address', contact = '$contact'";
        $result = $conn->query($sql);
        if($result === true) {
            echo"
            <script>
            alert('record updated successfully ');
            window.location.href='displayOrder.php';
            </script>
            ";
        }else {
            echo "error updating record:";
        }
    }
    if(isset($_GET['order_id'])) {
        $id = intval($_GET['order_id']);

        $sql = "select *from orders where order_id = '$id'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user_id = $row['user_id'];
                $quantity = $row['quantity'];
                $total_price = $row['total_price'];
                $order_date = $row['order_date'];
                $name = $row['name'];
                $address = $row['address'];
                $contact = $row['contact'];
            }
            ?>
            <form action="" method = "post">
                <h1>Order detail update form</h1>
                <input type="hidden" name="order_id" value="<?php echo ($order_id); ?>">

                <label for="tool_id">Tools Id:</label>
                <input type="text" name="tool_id" value="<?php echo ($tool_id); ?>" required>
                
                <label for="user_id">User Id:</label>
                <input type="text" name="user_id" value="<?php echo ($user_id); ?>" required>

                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" value="<?php echo ($quantity); ?>" required>

                <label for="total_price">Total Price</label>
                <input type="text" name="total_price" value="<?php echo ($total_price); ?>" required>

                <label for="order_date">Order Date</label>
                <input type="text" name="order_date" value="<?php echo ($order_date); ?>" required>
                
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo ($name); ?>" required>
                
                <label for="address">Address</label>
                <input type="text" name="address" value="<?php echo ($address); ?>" required>
                
                <label for="contact">Contact</label>
                <input type="text" name="contact" value="<?php echo ($contact); ?>" required>
                
                <input type="submit" name="update" value="Update">
                <a href="displayOrder.php" class="back-button">Back</a>
            </form>
            <?php
            } else{
                header('location:../displayOrder.php');
                exit;
            }
        }
    ?>    
</body>
</html>