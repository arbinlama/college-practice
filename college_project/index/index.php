<?php
include "conn.php";

// Fetch data for news from `news_tb`
$news_query = "SELECT title, detail, date FROM news_tb";
$news_result = $conn->query($news_query);
$news_date = [];
if ($news_result->num_rows > 0) {
    while ($row = $news_result->fetch_assoc()) {
        $news_data[] = $row;
    }
}

// Fetch data for upcoming programs from `upprogram_tb`
$upcoming_query = "SELECT heading, date, des FROM upprogram_tb";
$upcoming_result = $conn->query($upcoming_query);
$upcoming_data = [];
if ($upcoming_result->num_rows > 0) {
    while ($row = $upcoming_result->fetch_assoc()) {
        $upcoming_data[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Add your existing styles here -->
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="../footer/footer.css">
  <style>
    /* Your existing styles here */
    .top {
      display: flex;
      background: #4f4f4f;
      justify-content: center;
      height: 40px;
    }
    .top p {
      margin: 10px;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
    }
    .image-container {
      position: relative;
      width: 100%;
    }
    .image-container img {
      width: 100%;
      height: 500px;
    }
    .image-container .text {
      position: absolute;
      top: 10%; 
      left: 5%;
      width: 20%; 
      height: auto;
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px; 
      line-height: 1.6;
      background-color: rgba(0, 0, 0, 0.1); 
    }
    .text:hover {
      transform: scale(1.3);
    }
    .both {
     width: 80%;
     padding: 20px; 
     margin: 0 auto; 
     display: flex; 
     justify-content: center; 
     align-items: center; 
     text-align: center;
     height: 300px; 
    }
    .both > div {
      width: 50%;
      padding: 10px;
      margin: 10px;
      border-radius: 10px;
      height: 250px;
    }
    
    .upprog , .news {
      background: rgb(245, 245, 245);
      height: auto;
      text-align: left;
    }
    .upprog h1 , .news h1{
      text-decoration: underline;
      padding-left: 20px;
      margin-bottom: 20px;
    }
    .upprog p ,.news p {
      padding-left: 40px;
      line-height: 1.6;
      font-size: 18px;
    }
    .thead {
      width: 80%;
      height: 50px;
      display: flex;
      margin: 0 auto;
      justify-content: start;
    }
    .agritool {
      width: 80%;
      padding: 20px;
      margin: 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      height: 300px;
    }
    .thead h1 {
      display: flex;
      justify-content: start;
      text-align: left;
      align-items: start;
      font-weight: bold;
      padding-left: 50px;
    }
    .agritool > div {
      width: 50%;
      padding: 10px;
      margin: 10px;
      border-radius: 10px;
      height: 250px;
    }
    .account, .loan, .insurance {
      background: rgb(245, 245, 245);
      height: auto;
      text-align: left;
    }
    .account h1, .loan h1, .insurance h1 {
      display: flex;
      justify-content: center;
      font-weight: bold;
      top: 0;
    }
    .account p, .loan p, .insurance p {
      display: flex;
      justify-content: center;
      line-height: 1.6;
      font-size: 18px;
    }
    .account a, .loan a, .insurance a {
      display: flex;
      justify-content: center;
      text-decoration: underline;
      color: black;
      font-size: 20px;
    }
    .account a:hover,
    .loan a:hover,
    .insurance a:hover {
      color: red;
      transform: scale(1.2);
    }
    .partner {
      display: flex;
      justify-content: start;
      font-size: 30px;
      font-weight: bold;
      height: auto;
      padding-left: 230px;
      margin-bottom: 20px;
    }
    .bank {
      display: flex;
      padding: 20px;
      margin: 0 auto;
      background-color: rgb(245, 245, 245);
      justify-content: center;
      margin-bottom: 10px;
      width: 80%;
      border-radius: 10px;
    }
    .bank img {
      padding: 20px;
    }
    .bank a:hover {
      transform: scale(1.2);
    }
    .line {
      border-bottom: 1px solid black;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <header class="navbar-one">
    <div class="left flex">
      <div class="email">
        <a href=""><i class="fa fa-envelope"></i>
          AgriHub9988@gmail.com</a>
      </div>
      <div class="phone">
        <a href=""><i class="fa fa-phone-alt"></i>
          +0190005006
        </a>
      </div>
    </div>
    <div class="right">
      <div class="facebook">
        <a href=""><i class="fab fa-facebook"></i></a>
      </div>
      <div class="twitter">
        <a href=""><i class="fab fa-twitter"></i></a>
      </div>
      <div class="youtube">
        <a href=""><i class="fab fa-youtube"></i></a>
      </div>
      <div class="instagram">
        <a href=""><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </header>

  <nav class="navbar-second">
    <div class="logo">
      <img src="../image/ficon.png" alt="Logo">
      <p>AgriHub</p>
    </div>
    <ul>
      <li><a class='about' href="aboutus.html">About</a></li>
      <li>
        <a class='log' href="../loginpage/login.php">
          <i class="fa fa-user-circle"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="con">
    <div class="top">
      <p>Find your state/city's agriculture resources on AgriHub</p>
    </div>

    <div class="image-container">
      <img src="../image/farmer.jpg" alt="agri">
      <div class="text">
        This is about the development. Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Architecto tempora quia minima perferendis est blanditiis qui tenetur, corrupti animi,
        ad sunt pariatur excepturi molestiae porro deserunt aut quas rem ducimus.
      </div>
    </div>

    <div class="both">
      <div class="news" id="news-section">
        <h1>Latest News</h1>
        <?php if (!empty($news_data)): ?>
          <?php foreach ($news_data as $newsItem): ?>
              <p><strong><?php echo $newsItem['title']; ?></strong> (<?php echo $newsItem['date']; ?>)</p>
              <p>- <?php echo $newsItem['detail']; ?></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No news available at the moment.</p>
        <?php endif; ?>
      </div>

      <div class="upprog" id="upcoming-programs-section">
        <h1>Upcoming Programs</h1>
        <?php if (!empty($upcoming_data)): ?>
          <?php foreach ($upcoming_data as $program): ?>
            <p><strong><?php echo $program['heading']; ?></strong> - <?php echo $program['date']; ?></p>
            <p>- <?php echo $program['des']; ?></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No upcoming programs available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="thead">
      <h1>AgriHub Service</h1>
    </div>

    <div class="agritool">
      <div class="account">
        <h1>Your Agrihub account</h1>
        <p>Access secure self-service business tools like managing loans viewing farmers records</p>
        <a href="../register/reg.php">Create a new account</a>
      </div>

      <div class="loan">
        <h1>Loan</h1>
        <p>where you can find complete detail about government loan and its policy</p>
        <a href="https://doacrop.gov.np/public/uploads/file/Plan%20and%20policies%20related%20to%20the%20agroecosystem-99527.pdf">Read More</a>
      </div>

      <div class="insurance">
        <h1>About Insurance</h1>
        <p>We support farmer for claming insurance</p>
        <a href="https://nia.gov.np/">Read More</a>
      </div>
    </div>
    <p class="partner">Partners</p>

    <div class="bank">
     <a href="https://www.nabilbank.com/individual"> <img src="../image/nabil.png" alt="nabil bank"></a>
     <a href="https://www.siddharthabank.com/"> <img src="../image/shidartha.png" alt="shidartha bank"></a>
     <a href="https://www.prabhubank.com/"> <img src="../image/prabhau.png" alt="prabhau bank"></a>
     <a href="https://www.globalimebank.com/"> <img src="../image/global.png" alt="global bank"></a>
    </div>
    
    <div class="line"></div>
  </div>

  
  <div id="footer2"></div>
  
  <script>
    fetch("../footer/ifooter.html")
      .then(response => response.text())
      .then(data => document.getElementById('footer2').innerHTML = data)
      .catch(error => console.error('Error loading footer:', error));
  </script>

</body>
</html>
