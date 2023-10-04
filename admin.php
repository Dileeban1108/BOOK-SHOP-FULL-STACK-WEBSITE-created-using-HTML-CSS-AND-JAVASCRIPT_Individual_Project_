<?php
require 'dbc.php';
// session_start();
if(isset($_SESSION['new_user'])){
    $em=$_SESSION['new_user'];
    
    $choose=mysqli_query($connect,"SELECT * FROM user WHERE email='$em'");
    $row=mysqli_fetch_assoc($choose);

    
    $p= $row['passwrd'];

    $take=mysqli_query($connect, "SELECT * FROM superadmin WHERE  email='$em'  AND  passwrd='$p'");
     
    if(mysqli_num_rows($take)==0){
         header('Location:index.php');
        
     
    } 
       
}else{
     header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    $output="";
    if(isset($_POST['submit'])){
        $adminName=$_POST['name'];
        $phoneNumber=$_POST['pNumber'];
        $email=$_POST['email'];
        $password=md5($_POST['pwd']);
        $confirmPassword=md5($_POST['cpwd']);

        $chkname="SELECT * FROM admi WHERE userName='$adminName';";
        $chkmail="SELECT * FROM admi WHERE email='$email';";

        $result1=mysqli_query($connect,$chkname);
        $result2=mysqli_query($connect,$chkmail);
        
        $chkresult1=mysqli_num_rows($result1);
        $chkresult2=mysqli_num_rows($result2);
        $error=array();
        if(empty($adminName)){
            $error['l']="Enter admin name";
        }else if(empty($phoneNumber)){
            $error['l']="Enter admin number";
        }else if(empty($email)){
            $error['l']="Enter admin email";
        }else if(empty($password)){
            $error['l']="Enter password";
        }else if($password!==$confirmPassword){
            $error['l']="password don't match";
        }else if($chkresult1>0){
            $error['l']="name already exist";
        }else if($chkresult2>0){
            $error['l']="email already exist";
        }

        if(isset($error['l'])){
            $output .= "<p class='alert'>" . $error['l'] . "</p>";
        }else{
            $output .= "";  
        }
        if(count($error)<1){
            $sql1="INSERT INTO admi (userName,email,phoneNumber,passwrd) VALUES('$adminName','$email','$phoneNumber','$password');";
            $sql2="INSERT INTO user (userName,email,phoneNumber,passwrd) VALUES('$adminName','$email','$phoneNumber','$password');";
            $result1=mysqli_query($connect,$sql1);
            $result2=mysqli_query($connect,$sql2);
            if ($result1 AND $result2) {
                $output .= "<p class='success'>You have added a new admin</p>";
                header("Location:index.php?SIGNUP=SUCCESS");
            } else {
                $output .= "<p class='alert'>Failed to add a new admin</p>";
            }
        }
    }
    
    ?>
</body>
</html>