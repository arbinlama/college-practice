<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session itself
session_destroy();

// Redirect to the login page after logout
header("Location: ../loginpage/login.php");
exit;
?>
