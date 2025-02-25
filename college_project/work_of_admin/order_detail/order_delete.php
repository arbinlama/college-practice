<?php 
include "conn.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $sql = "DELETE FROM orders WHERE order_id = $id";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<script>
            alert('Record deleted successfully');
            window.location.href = 'displayOrder.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
