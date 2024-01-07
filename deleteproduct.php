<?php
require 'dbc.php';
session_start();

if(isset($_GET['logout'])){
    session_destroy();
    header("Location:home.php");
}

if(isset($_SESSION['new_user'])){
    $em=$_SESSION['new_user'];  
    $sql=mysqli_query($connect,"SELECT * FROM user WHERE email='$em';");
    $row2=mysqli_fetch_assoc($sql);
    if(!mysqli_num_rows($sql)>0){
        header("Location:home.php");
    }
} else{
    header("Location:home.php");  
} 


if(isset($_GET['prId'])){
    $product = $_GET['prId'];
    mysqli_query($connect, "DELETE FROM cart WHERE productId='$product'");
    $_SESSION['cart_count']--;
    header("Location:cart.php");
}
?>