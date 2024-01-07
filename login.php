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
                <a href="signup.php">sign up</a>
            </div>
        </div>
        <div class="homebtn">
                <a href="index.php">Home</a>
        </div>
        <div>
            
        </div>
    </div>
</body>
</html>