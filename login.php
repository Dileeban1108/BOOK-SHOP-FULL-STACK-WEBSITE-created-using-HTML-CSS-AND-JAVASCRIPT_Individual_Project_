<?php
require 'dbc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="login_container">
        <div class="login">
            <div class="title">Sign In</div>
            <?php
            include 'check.php';
            echo $output;
            ?>
            <form action="login.php" method="POST">
                <div class="input-boxL">
                    <input type="email" placeholder="Email" name="email">
                </div>
                <div class="input-boxL">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="button">
                    <input type="submit" value="Sign In" name="submit">
                </div>
            </form>
            <div class="directToLogin">
                <h4>Dont have an account?</h4>
                <div class="button">
                    <a href="signup.php">sign Up</a>
                </div>
            </div>
            <div class="homebtn">
                <a href="index.php">Home</a>
            </div>
            <div>

            </div>
        </div>
    </div>

    <section class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>Welcome to our bookshop. We offer a wide range of books across various genres to cater to all book lovers. Our mission is to promote reading and provide the best books at affordable prices.</p>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: info@bookshop.com</p>
                <p>Phone: +123 456 789</p>
                <p>Address: 123 Bookshop St, Book City, BK 10001</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 Bookshop | Designed by YourName
        </div>
    </section>
</body>

</html>