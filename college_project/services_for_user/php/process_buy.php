<?php
include "conn.php";

// Get form data
$tool_id = $_POST['tool_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// Check if the requested quantity is available in the database
$sql = "SELECT * FROM tool_tb WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tool_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tool = $result->fetch_assoc();
    
    // Check if enough quantity is available
    if ($tool['quantity'] >= $quantity) {
        // Enough stock, proceed with the order
        $total_price = $price * $quantity;

        // Insert the order into the orders table
        $order_sql = "INSERT INTO orders (tool_id, quantity, total_price, order_date) VALUES (?, ?, ?, NOW())";
        $order_stmt = $conn->prepare($order_sql);
        $order_stmt->bind_param("iid", $tool_id, $quantity, $total_price);
        $order_stmt->execute();
        
        // Reduce the stock by the ordered quantity
        $new_quantity = $tool['quantity'] - $quantity;
        $update_sql = "UPDATE tool_tb SET quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $tool_id);
        $update_stmt->execute();
        
        echo "
        <script>
            showModal('Order placed successfully!', 'your-redirect-url.php');
        </script>";
        
    } else {
        // Not enough stock
        echo "
        <script>
            showModal('Sorry, not enough stock available!', 'your-redirect-url.php');
        </script>";
    }
} else {
    echo "
    <script>
        showModal('Tool not found!', 'your-redirect-url.php');
    </script>";
}
?>

<!-- Modal Styles -->
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 100%;
    }
    .modal button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .modal button:hover {
        background-color: red;
    }
</style>

<!-- Modal HTML -->
<div id="modal" class="modal">
    <div class="modal-content">
        <p id="modalMessage"></p>
        <button onclick="closeModal()">OK</button>
    </div>
</div>

<!-- JavaScript to show/hide modal and redirect -->
<script>
    function showModal(message, redirectUrl) {
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('modal').style.display = 'flex';

        // Redirect after 2 seconds to allow the user to see the message
        setTimeout(function() {
            window.location.href = redirectUrl;
        }, 2000);
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
