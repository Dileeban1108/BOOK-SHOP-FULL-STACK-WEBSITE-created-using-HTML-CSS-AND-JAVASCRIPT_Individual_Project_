
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
if(isset($_POST['submit'])){
 $productId=$_POST['prodId'];
 $productqty=$_POST['qty'];
 mysqli_query($connect, "UPDATE cart SET qty=$productqty WHERE productId=$productId");
 header("Location:cart.php");

}
?>