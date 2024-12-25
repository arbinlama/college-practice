<?php 
include "price_detail/conn.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID input

    // Delete related rows in training_details
    $deleteDetails = "DELETE FROM training_details WHERE training_id = $id";
    if ($conn->query($deleteDetails) === TRUE) {
        // Delete the row in training_tb
        $deleteTraining = "DELETE FROM training_tb WHERE id = $id";
        if ($conn->query($deleteTraining) === TRUE) {
            echo "<script>
                alert('Record deleted successfully.');
                window.location.href = 'displayTraining.php';
            </script>";
        } else {
            echo "Error deleting record from training_tb: " . $conn->error;
        }
    } else {
        echo "Error deleting record from training_details: " . $conn->error;
    }
} else {
    header('Location: displayTraining.php');
}
$conn->close();
?>

