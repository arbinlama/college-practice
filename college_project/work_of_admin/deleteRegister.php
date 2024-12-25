<?php
include "price_detail/conn.php";

if(isset($_GET['id'])) {

    $id =  $_GET['id'];
    $sql = "DELETE FROM training_register_tb WHERE id = '$id'";
    $result = $conn->query($sql);

    if($result === true) {
        echo "
        <script>
        alert('Record deleted successfully');
        window.location.href ='displayTrainingReg.php';
        </script>
        ";
    }else {
        echo 'error deleteing record: ' .$conn->error;
    }
}
?>