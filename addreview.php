<?php
require 'dbc.php';
if(isset($_SESSION['new_user'])){
    $em=$_SESSION['new_user'];  
    $sql=mysqli_query($connect,"SELECT * FROM user WHERE email='$em';");
    $row=mysqli_fetch_assoc($sql);
    if(!mysqli_num_rows($sql)>0){
        header("Location:home.php");
    }
} else{
    header("Location:home.php");  
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reviews</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){

       $name=$_POST['rn'];
       $des=$_POST['des'];
       
        $insert=mysqli_query($connect,"INSERT INTO review(reviewerName ,review)
        VALUES('$name','$des')") or die('query failed');
            if($insert){
                    header("Location:index.php");
            }
       }
    ?>
</body>
</html>