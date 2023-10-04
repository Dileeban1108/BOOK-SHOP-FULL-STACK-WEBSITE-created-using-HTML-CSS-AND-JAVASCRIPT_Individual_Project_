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
        <?php
        include 'check.php';
        echo "";
        ?>
        <?php
        if(isset($_SESSION['new_user'])){
        $ue=$_SESSION['new_user'];
        $e=mysqli_query($connect,"SELECT *FROM user where email='$ue'");
        $row=mysqli_fetch_assoc($e);
        echo "<div class='profile'>
            <h3>profile</h3>
            <p>".$row['userName']."</p>
            <p>".$row['phoneNumber']."</p>
            <p>".$row['email']."</p>
            <div class='con1'>
                <a href='index.php?logout' class='logoutbtn'>logout</a>
                <a href='index.php' class='homtbtn'>Home</a>
            </div>
          </div>"; 
        }
        else{
            echo '
            <div class="title">Sign In</div>'
            .$output.
        '<form action="login.php" method="POST">
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
        </div>';
        }
        
        ?>
      

    </div>
</body>
</html>