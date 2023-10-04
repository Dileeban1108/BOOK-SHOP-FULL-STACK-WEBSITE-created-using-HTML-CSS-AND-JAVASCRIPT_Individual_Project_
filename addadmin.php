<?php
require 'dbc.php';

session_start();

if(isset($_SESSION['new_user'])){
    $em=$_SESSION['new_user'];
    
    $choose=mysqli_query($connect,"SELECT * FROM user WHERE email='$em'");
    $row=mysqli_fetch_assoc($choose);

    
    $p= $row['passwrd'];

    $take=mysqli_query($connect, "SELECT * FROM superadmin WHERE  email='$em'  AND  passwrd='$p'");
     
    if(mysqli_num_rows($take)==0){
         header('Location:home.php');
    } 
       
}else{
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
<?php
 
?>
    <div class="admin-adder">
        <div class="title">
            add admin
        </div>

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
            <div class="button">
                <input type="submit" value="add" name="submit">
            </div>
        </form>
        <div class="profile1">
            <div class="con2">
                <a href='index.php' class='homtbtn'>Home</a>
            </div>
        </div>
    </div>
    <script src="phone-number-validation\build\js\intlTelInput.js"></script>
    <script>
        var input=document.querySelector('#phone');
        
        window.intlTelInput(input,{});
    </script>
</body>
</html>