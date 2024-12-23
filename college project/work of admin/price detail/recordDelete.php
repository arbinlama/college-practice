<?php 
include "conn.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $sql = "DELETE FROM price_tb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<script>
            alert('Record deleted successfully');
            window.location.href = '../adminprice.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
