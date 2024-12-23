<?php 
include "../image_insert/conn.php"; 
$sql = "SELECT * FROM image_tb WHERE id = 39"; 
$result = $conn->query($sql); 
$image_path = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    $image_path = "../database_image/" . $row['name']; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in form </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="logout.css">
    <style>
        body {
            background-image: url('<?php echo $image_path; ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="loginform">
        <span class="cross">
            <i class="bx bx-x"></i>
        </span>
        <form action="../php/plogout.php" method="POST"> <!-- Action set to login.php with POST method -->
            <h1>Profile</h1>
           
            <button type="submit" class="btn" name="logout">Logout</button>
        </form>
    </div>
    <script>
        // JavaScript to redirect to the index page when the cross button is clicked
        const crossButton = document.querySelector('.cross');
        crossButton.addEventListener('click', () => {
            window.location.href = "../adminindex/admindashboard.html";
        });
    </script>
</body>
</html>
