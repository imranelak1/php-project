<?php
session_start();
if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = $username; 

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <img class="logo" src="images/logo1.png" alt="" width="100px" height="50px">
    
    <ul class="menu">
        <li><a href="aboutus.html">About us</a></li>
        <li><a href="#">Blog</a></li>
        <li class="header-btn"><a href="plans.html">View plans</a></li>

        <!-- Right-aligned items -->
        <div class="nav-right">
        <li class="welcome-message"><?php echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?></li>

            <li><a href="logout.php">Logout</a></li>
        </div>
    </ul>
</header>
    
    <div class="content">
        
        <div class="center">
            <div class="content-text">
                <h1>Humanizing </h1>
                <h1>your insurance.</h1>
                <p>Get your life insurance coverage easier and gaster. We blend our expertise and technology to help you find the plan that's right for you. Ensure you and your loved ones are protected</p>
                <a href="plans.html" class="content-btn">view plans</a>
            </div>
            
       
        <img src="images/human.jpeg" alt="">
        
    </div>
    <div class="second-content">
        <h1>We're different</h1>
        <div class="introduce">
            <div class="col-4">
                <img src="images/process.png" alt="">
                <h4 class="title">Snappy Process</h4>
                <p class="short-info">
                    Our appilication process can be completed in minutes, not hours. Don't get stuck filling in tedious forms
                </p>
            </div>
            <div class="col-4">
                <img src="images/prices.jpeg" alt="">
                <h4 class="title">Affordable Prices</h4>
                <p class="short-info">We don't want you worrying about high monthly costs. Our prices may be low, but we still offer the best coverage possible.</p>
            </div>
            <div class="col-4">
                <img src="images/people.png" alt="">
                <h4 class="title">People First</h4>
                <p class="short-info">Our plans aren't full of conditions and clauses to prevent payouts. We make sure you're covered when you need it</p>

            </div>
        </div>
        <div class="banner">
            <img src="images/how we work.jpeg"  class ="desktop" alt="">
            
            <h1>Find our more about how we work</h1>
            <a href="aboutus.html">How we work</a>

        </div>
    </div>
    <footer>
       
        <div class="up">
            
        </div>
        <div class="down">
            <div class="col-3">
                <a href="#" class="title">our company</a>
                <a href="#">How we work</a>
                <a href="#">why insure?</a>
                <a href="plans.html">view plans</a>
                <a href="#">reviews</a>
            </div>
            <div class="col-3">
                <a href ="#" class="title">help me</a>
                <a href ="#" >faq</a>
                <a href ="#" >terms of use</a>
                <a href ="#" >privacy policy</a>
                
            </div>
           
            
        </div>
        <script src="index.js"></script>
    </footer>
</body>
</html>