<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Training</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            padding: 20px;
            width: 60%;
            background-color: #ddd;
            border: none;
        }

        /* Flexbox for horizontal layout */
        .block-container {
            display: flex;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            position: relative; /* Ensure the image stays relative to the section */
            overflow: hidden; /* Keeps the image confined to the section */
        }

        h1 {
            color: #264722;
            margin-bottom: 10px;
            font-size: 30px;
        }

        h2 {
            color: #128405;
            margin-bottom: 10px;
            font-size: 25px;
        }

        .training-description {
            color: #0a0909;
            margin-bottom: 15px;
            font-size: 20px;
        }

        section {
            display: flex;
            width: 100%;
            margin: 0;
        }

        article {
            padding: 0;
            margin: 0;
        }

        .cont-row {
            background-color: rgb(111, 169, 111);
            color: #fff;
            padding: 20px;
            font-size: 20px;
            width: 40%;
            position: relative; /* To ensure text flows above the image */
            z-index: 1; /* Keeps the text content above the image */
        }

        .nav-title {
            margin-top: 5px;
            font-size: 40px;
            font-weight: 700;
        }

        .detail-section {
            background-color: rgb(111, 169, 111);
            color: #fff;
            font-size: 25px;
            padding: 20px;
            width: 40%;
            position: relative; /* To ensure text flows above the image */
            z-index: 1; /* Keeps the text content above the image */
        }

        .detail-section p {
            border: none;
            width: fit-content;
            color: green;
            margin-top: 40px;
            background: white;
        }

        .training-image {
            width: 100%; /* Ensure the image scales dynamically */
            height: auto;
            max-width: none;
            max-height: none;
            object-fit: cover; /* Crops and fits the image nicely */
            position: absolute;
            top: 0;
            right: 0; /* Position the image at the right side of the section */
            z-index: -1; /* Place the image behind the text content */
        }
    </style>
</head>
<body>
    <div class="container">
        <p><a href="../adminiindex/admindashboar.html">Home</a></p>
        <?php
        include "price detail/conn.php"; // Include database connection

        // Query to fetch all training details
        $query = "SELECT * FROM training_tb";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Extract data from the row
                $heading = htmlspecialchars($row['heading']);
                $sub_heading = htmlspecialchars($row['sub_heading']);
                $exp1 = htmlspecialchars($row['exp1']);
                $diff = htmlspecialchars($row['diff']);
                $t_description = htmlspecialchars($row['t_description']);
                $class_duration = htmlspecialchars($row['class_duration']);
                $class_time = htmlspecialchars($row['class_time']);
                $training_schedule = htmlspecialchars($row['training_schedule']);
                $image = htmlspecialchars($row['image']);

                // Render the content dynamically
                echo "
                <h1>$heading</h1>
                <h2>$sub_heading</h2>
                <p class='training-description'>$exp1</p>

                <section class='block-container'>
                    <article class='cont-row'>
                        <p class='nav-title'>$diff</p>
                        <p>$t_description</p>
                    </article>
                    
                    <article class='detail-section'>
                        <p>$class_duration</p>
                        <p>$class_time</p>
                        <p>$training_schedule</p>
                    </article>
                    
                    <article>
                        <img src='../training_image/$image' alt='Training Image' class='training-image'>
                    </article>
                </section>
                ";
            }  
        } else {
            echo '<p>No training details found.</p>';
        }
        ?>
    </div>
</body>
</html>
