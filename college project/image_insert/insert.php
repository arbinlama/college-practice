<?php 
include "conn.php";
if(isset($_POST['submit'])){
    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name']; // Corrected to use 'tmp_name'
    $folder = '../database_image/'.$file_name;

    // Insert file name into the database
    $query = mysqli_query($conn, "INSERT INTO image_tb (name) VALUES ('$file_name')");

    if($query && move_uploaded_file($temp_name, $folder)) {
        echo "File uploaded successfully";
    } else {
        echo "File not uploaded or database error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" autocomplete ="off">
        <input type="file" name="image" required>
        <br> <br>
        <button type="submit" name="submit">Submit</button>
        <button type="submit" name="data"><a href="view.php">Data</a></
    </form>
   
</body>
</html>
