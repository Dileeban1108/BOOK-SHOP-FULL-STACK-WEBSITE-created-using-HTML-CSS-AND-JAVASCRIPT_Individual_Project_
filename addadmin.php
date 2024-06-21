<?php
require 'dbc.php';

session_start();

if (isset($_SESSION['new_user'])) {
    $em = $_SESSION['new_user'];

    $choose = mysqli_query($connect, "SELECT * FROM user WHERE email='$em'");
    $row = mysqli_fetch_assoc($choose);


    $p = $row['passwrd'];

    $take = mysqli_query($connect, "SELECT * FROM superadmin WHERE  email='$em'  AND  passwrd='$p'");

    if (mysqli_num_rows($take) == 0) {
        header('Location:home.php');
    }
} else {
    header('Location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add admin</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\demo.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\intlTelInput.css">
</head>

<body>
    <div class="addaddmin_container">

        <div class="login">
            <div class="title">add admin</div>

            <?php
            // if(isset($output)){
            include 'admin.php';
            echo $output;
            // }
            ?>

            <form action="addadmin.php" method="POST">
                <div class="input-box">
                    <input type="text" placeholder="enter name" name="name">
                </div>
                <div class="input-box">
                    <input type="tel" id="phone" max="10" placeholder="enter phone number" name="pNumber">
                </div>
                <div class="input-box" style="width: 100%;">
                    <input type="email" placeholder="enter email" name="email">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="enter password" name="pwd">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="confirm password" name="cpwd">
                </div>
                <div class="button" style="width: 100%;">
                    <input type="submit" value="add" name="submit">
                </div>
            </form>
            <div class="directToLogin">
                <div class="button">
                    <a href="index.php">HOME</a>
                </div>
            </div>
        </div>
    </div>
    <section class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>Welcome to our bookshop. We offer a wide range of books across various genres to cater to all book lovers. Our mission is to promote reading and provide the best books at affordable prices.</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#reveiw">Review</a></li>
                </ul>
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
    <script src="phone-number-validation\build\js\intlTelInput.js"></script>
    <script>
        var input = document.querySelector('#phone');

        window.intlTelInput(input, {});
    </script>
    </div>
</body>

</html>