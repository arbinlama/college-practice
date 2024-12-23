<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="priceupdate.css">
</head>
<body>
<?php
include "conn.php";

if (isset($_POST['update'])) {
    $p_id = $_POST['id'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $minimum = $_POST['minimum'];
    $maximum = $_POST['maximum'];
    $average = $_POST['average'];

    $sql = "UPDATE price_tb SET name='$name', unit='$unit', minimum='$minimum', maximum='$maximum', average='$average' WHERE id='$p_id'";
    $result = $conn->query($sql);

    if ($result ===true) {
        echo "<script>
            alert('Record update successfully');
            window.location.href = '../adminprice.php';
        </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $p_id = $_GET['id'];

    $sql = "SELECT * FROM price_tb WHERE id = '$p_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){

         $name = $row['name'];
         $unit = $row['unit'];
         $minimum = $row['minimum'];
         $maximum = $row['maximum'];
         $average = $row['average'];
        }
        ?>
        
        <form action="" method="POST">
            <h2>Price Update Form</h2>
            <fieldset>
                <legend>Update Information</legend>

                <input type="hidden" name="id" value="<?php echo $p_id; ?>">

                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
                
                <label for="unit">Unit</label>
                <input type="text" name="unit" value="<?php echo $unit; ?>" required>

                <label for="minimum">Minimum</label>
                <input type="text" name="minimum" value="<?php echo $minimum; ?>" required>

                <label for="maximum">Maximum</label>
                <input type="text" name="maximum" value="<?php echo $maximum; ?>" required>

                <label for="average">Average</label>
                <input type="text" name="average" value="<?php echo $average; ?>" required>

                <input type="submit" name="update" value="Update">
                <a href="../adminprice.php" style="background-color: yellow;">Back</a>
            </fieldset>
        </form>

    <?php
    } else {
        header('location:../work of admin/price detail/adminprice.php');
        exit;
    }
}
 ?>
</body>
</html>
<?php
