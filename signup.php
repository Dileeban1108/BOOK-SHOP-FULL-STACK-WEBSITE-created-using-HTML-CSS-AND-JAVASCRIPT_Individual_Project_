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
    <div class="registration">
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
                    <a href="login.php">Login</a>
                </div>
        </div>
        <div class="homebtn">
            <a href="index.php">Home</a>
        </div>
    </div>
    <script src="phone-number-validation\build\js\intlTelInput.js"></script>
    <script>
        var input=document.querySelector('#phone');
        window.intlTelInput(input,{});
    </script>
</body>
</html>