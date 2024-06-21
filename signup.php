<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\demo.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\intlTelInput.css">
</head>

<body>
    <div class="reg_container">

        <div class="login">
            <div class="title">Registration</div>
            <?php
            include 'register.php';
            echo $output;
            ?>
            <form action="signup.php" method="POST">
                <div class="input-box">
                    <input type="text" placeholder="Full Name" name="fn">
                </div>
                <div class="input-box">
                    <input type="tel" id="phone" min="0" max="10" placeholder="phone number" name="number">
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="el">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="pwd">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Confirm password" name="cpwd">
                </div>
                <div class="button">
                    <input type="submit" value="register" name="submit">
                </div>
            </form>
            <div class="directToLogin">
                <h4>Already have an account?</h4>
                <div class="button">
                    <a href="login.php">sign In</a>
                </div>
            </div>
            <div class="homebtn">
                <a href="index.php">Home</a>
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
    <script src="phone-number-validation\build\js\intlTelInput.js"></script>
    <script>
        var input = document.querySelector('#phone');
        window.intlTelInput(input, {});
    </script>
</body>

</html>