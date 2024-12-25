<?php 
include "../price_detail/conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the id from the query string

    $sql = "DELETE FROM tool_tb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<script>
            alert('Record deleted successfully');
            window.location.href = 'toolsDisplay.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
