<?php 
include "conn.php";
 if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $minimum = $_POST['min'];
    $maximum = $_POST['max'];
    $average = $_POST['average'];

    $sql = "insert into price_tb (name, unit, minimum, maximum, average ) values('$name', '$unit', '$minimum', '$maximum', '$average')";

    $result = $conn->query($sql);

    if($result == true){
         echo "<script>
                    alert('Insert new item successfully');
                    window.location.href = '../adminprice.php';
                  </script>";
            exit();
    }else {
        echo "error to create new record.";
    }
    $conn->close();
}
?>