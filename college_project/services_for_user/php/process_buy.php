<?php
include "conn.php";

// Get form data
$tool_id = $_POST['tool_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$name = $_POST['name']; // Get name from form
$user_id = $_POST['userid'];
$address = $_POST['address']; // Get address from form
$contact = $_POST['contact'];

// Check if the requested quantity is available in the database
$sql = "SELECT * FROM tool_tb WHERE id = $tool_id"; // Directly using $tool_id
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tool = $result->fetch_assoc();
    
    // Check if enough quantity is available
    if ($tool['quantity'] >= $quantity) {
        // Enough stock, proceed with the order
        $total_price = $price * $quantity;

        // Insert the order into the orders table, including name and address
        $order_sql = "INSERT INTO orders (tool_id, quantity, total_price, order_date, name, address, contact,user_id) VALUES ($tool_id, $quantity, $total_price, NOW(), '$name', '$address', '$contact', '$user_id')";
        $conn->query($order_sql);
        
        // Reduce the stock by the ordered quantity
        $new_quantity = $tool['quantity'] - $quantity;
        $update_sql = "UPDATE tool_tb SET quantity = $new_quantity WHERE id = $tool_id";
        $conn->query($update_sql);
        
        $message = 'Order placed successfully!';
    } else {
        // Not enough stock
        $message = 'Sorry, not enough stock available!';
    }
} else {
    $message = 'Tool not found!';
}

// Close the connection
$conn->close();
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
        <p id="modalMessage"><?php echo isset($message) ? $message : ''; ?></p>
        <button onclick="closeModal()">OK</button>
    </div>
</div>

<!-- JavaScript to show/hide modal and redirect -->
<script>
    window.onload = function() {
        var modalMessage = "<?php echo isset($message) ? $message : ''; ?>";
        if (modalMessage) {
            showModal(modalMessage);
        }
    };

    function showModal(message) {
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('modal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
        // Redirect after closing the modal
        window.location.href = 'toolDetail.php';
    }
</script>
