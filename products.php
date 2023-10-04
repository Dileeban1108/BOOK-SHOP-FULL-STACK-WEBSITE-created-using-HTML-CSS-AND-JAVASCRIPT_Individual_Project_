<?php
require 'dbc.php';
session_start();
if(isset($_SESSION['new_user'])){
    $e=$_SESSION['new_user'];
    $res="SELECT * FROM user WHERE email='$e';";
    $con=mysqli_query($connect,$res);
    $row=mysqli_fetch_assoc($con);
    $pws=$row['passwrd'];
    $res1="SELECT * FROM admi WHERE email='$e' AND passwrd='$pws';";
    $res2="SELECT * FROM superadmin WHERE  email='$e' AND passwrd='$pws';";
    $tke=mysqli_query($connect,$res1);
    $tke2=mysqli_query($connect,$res2);

    if(!mysqli_num_rows($tke)>0 AND !mysqli_num_rows($tke2)>0){
        header("Location:home.php");
    }
}
else{
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add products</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="registration">
        <div class="title">add products</div>
        <?php
            include 'addproducts.php';
           if(isset($output)){
            echo $output;

           }
        ?>
        <form action="products.php" method="POST"  enctype="multipart/form-data">
            <div class="input-box">
                <input type="text" placeholder="product Name" name="pn">
            </div> 
            <div class="input-box">
                <input type="number" min="0" max="1000"placeholder="quantity" name="qty">
            </div>
            <div class="input-box">
                <input type="number" placeholder="price" name="pc">
            </div>
            <div class="input-box">
                <input type="file" accept="image/png, image/jpg, image/jpeg" name="p_image">
            </div>
            <div class="input-box" style="width:100%; ">
                <input style="height: 80px;"type="text" placeholder="write something about the product" name="des">
            </div> 
            <div class="button">
                <input type="submit" value="add" name="submit">
            </div>
        </form>
        <div class="directToLogin">
                <!-- <h4>Back to home</h4> -->
                <div class="button">
                    <a href="index.php">HOME</a>
                </div>
        </div>
    </div>
</body>
</html>