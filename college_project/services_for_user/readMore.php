<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Details</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .right-half {
            padding: 0;
            text-align: left;
            background-color: green;
            border-radius: 10px;
            margin-top: 500px;
            height: 830px;
            overflow: hidden;
            display: flex;
            opacity: 60%;
            flex-direction: column;
        }

        .right-half h1 {
            margin: 10px 0;
            color: #fff;
            font-size: 30px;
            padding-left: 30px;
        }

        .right-half h2 {
            color: #fff;
            padding-left: 30px;
        }

        .image-container {
            text-align: center;
            margin: 30px 0;
            height: 50%;
            width: 50%;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10%;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: rgb(194, 204, 195);
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .left-half,
        .right-half {
            width: 48%;
        }

        .exp {
            color: #fff;
            font-size: 20px;
            padding-left: 30px;
        }

        .right-half .time {
            padding-left: 30px;
        }

        .right-half .time p {
            display: flex;
            align-items: center;
            background-color: #fff;
            color: green;
            height: 50px;
            width: fit-content;
            font-size: 25px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .diff {
            font-weight: 1000;
            font-size: 30px;
            color: #fff;
            padding-left: 30px;
        }

        .left-half .hhh a {
            font-size: 15px;
            color: black;
            text-decoration: underline;
            text-decoration-color: black;
        }

        .left-half .t_head {
            font-size: 40px;
            font-weight: 400;
            color: green;
        }

        .left-half .time {
            margin-top: 100px;
            opacity: 85%;
        }

        .left-half .t_sub {
            font-size: 25px;
            color: brown;
            font-weight: 1000;
            width: 100%;
        }

        .what {
            font-weight: 700;
            font-size: 25px;
        }

        .des,
        .what_to {
            font-size: 20px;
            opacity: 80%;
            color: black;
        }

        .left-half .time_head {
            font-size: 25px;
            font-weight: 700;
        }

        .left-half .time p {
            font-size: 20px;
            margin-bottom: 10px;
        }

        ul li {
            margin-top: 15px;
        }

        .reg {
            font-size: 25px;
            font-weight: 600;
            opacity: 75%;
        }

        .reg1 {
            font-size: 18px;
        }

        /* Flexbox update for right side */
        .right-half .details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .right-half .time {
            flex: 1;
            padding-left: 30px;
        }

        .right-half .image-container {
            width: 40%;
            text-align: center;
            padding: 20px;
        }

        .lll {
            border-top: 1px solid black;
        }

        .part {
            font-size: 25px;
            font-weight: bold;
        }

        .partner {
            display: flex;
            justify-content: center;
            color: brown;
            font-size: 25px;
            opacity: 85%;
            height: 120px;
            width: 80%;
            overflow: hidden;
        }

        .partner img {
            padding-left: 20px;
            margin: 10px;
            max-height: 100px;
            max-width: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Include the database connection file
        include "../work_of_admin/price_detail/conn.php"; 

        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);  // Sanitize the incoming id

            // Query to get training data
            $sql = "SELECT t.*, td.* FROM training_tb t LEFT JOIN training_details td ON t.id = td.training_id WHERE t.id = '$id'";
            $result = $conn->query($sql);

            // Check if any row is returned
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Sanitize and store fetched data
                $heading = htmlspecialchars($row['heading']);
                $sub_heading = htmlspecialchars($row['sub_heading']);
                $exp1 = htmlspecialchars($row['exp1']);
                $diff = htmlspecialchars($row['diff']);
                $t_description = htmlspecialchars($row['t_description']);
                $class_duration = htmlspecialchars($row['class_duration']);
                $class_time = htmlspecialchars($row['class_time']);
                $training_schedule = htmlspecialchars($row['training_schedule']);
                $image = htmlspecialchars($row['image']);

                $t_heading = htmlspecialchars($row['t_heading']);
                $t_sub_heading = htmlspecialchars($row['t_sub_heading']);
                $what_do = htmlspecialchars($row['what_do']);
                $description = htmlspecialchars($row['description']);
                $time_heading = htmlspecialchars($row['time_heading']);
                $t_data = htmlspecialchars($row['t_data']);
                $t_time = htmlspecialchars($row['t_time']);
                $place = htmlspecialchars($row['place']);

                // Display the training details
                echo "<div class='row'>";

                // Left side: Training Details
                echo "<div class='left-half'>
                        <div class='hhh'>
                            <a href='../../userindex/userdashboard.html'>home//</a>
                            <a href='training.php'>Farmer training</a>
                        </div>
                        <p class='t_head'>$t_heading</p>
                        <p class='t_sub'>$t_sub_heading</p>
                        <p class='what'><strong>In this free workshop you will:</strong></p>
                        <ul>";

                // Split and display `what_do` text as list items
                $what_do_items = preg_split("/[.]\s*|\n/", $what_do, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($what_do_items as $item) {
                    echo "<li class='what_to'>" . htmlspecialchars(trim($item)) . "</li>";
                }

                echo "</ul>
                        <p class='des'>$description</p>
                        <div class='time'>
                            <p class='time_head'>$time_heading</p>
                            <p><strong>December Date:</strong> $t_data</p>
                            <p><strong>Time:</strong> $t_time</p>
                            <p><strong>Place:</strong> $place</p>
                        </div>

                        <div class='reg'>
                            <p>How to Register:</p>
                            <p class='reg1'>
                                Register by filling out our registration form by clicking 
                                <a href='tRegister.php?id=" . urlencode($id) . "'>here</a>
                            </p>
                            <p class='reg1'>
                                As the day of the workshop approaches, people who registered will get an email with a Zoom link to the online meeting.
                            </p>
                        </div>
                    </div>";

                // Right side: Additional Information
                echo "<div class='right-half'>
                        <h1>$heading</h1>
                        <h2>$sub_heading</h2>
                        <p class='exp'>$exp1</p>
                        <p class='diff'>$diff</p>
                        <p class='exp'>$t_description</p>
                        <div class='details'>
                            <div class='time'>
                                <p>$class_duration</p>
                                <p>$class_time</p>
                                <p>$training_schedule</p>
                            </div>
                            <div class='image-container'>
                                <img src='../training_image/$image' alt='Training Image'>
                            </div>
                        </div>
                    </div>";

                echo "</div>";  // Closing row div
            } else {
                // If no record found
                echo "<script>
                        alert('No record found!');
                        window.location.href = 'training.php';
                    </script>";
            }
        } else {
            // Redirect if no id is provided
            header('location:toolsDisplay.php');
        }
        ?>
        <a href="training.php" class="btn">Back to Trainings</a>
        <p class='lll'></p>
        <p class='part'>Training Partners</p>
        <div class='partner'>
            <a href='https://ctevt.org.np/trainingportal/public/'><img src='../image/ctevt.png' alt="image loading"></a>
            <a href='https://www.herbnepal.com/'><img src='../image/herb.png' alt="image loading"></a>
            <a href='https://organichasera.org/'><img src='../image/hasera.png' alt="image loading"></a>
        </div>
    </div>
</body>

</html>
