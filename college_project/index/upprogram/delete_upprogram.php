<?php
include "conn.php";

if(isset($_GET['id'])) {

    $id =  $_GET['id'];
    $sql = "DELETE FROM upprogram_tb WHERE id = '$id'";
    $result = $conn->query($sql);

    if($result === true) {
        echo "
        <script>
        alert('Record deleted successfully');
        window.location.href ='display.php';
        </script>
        ";
    }else {
        echo 'error deleteing record: ' .$conn->error;
    }
}
?>