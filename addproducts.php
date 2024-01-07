<?php
require 'dbc.php';
$output="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){

       $name=$_POST['pn'];
       $quantity=$_POST['qty'];
       $price=$_POST['pc'];
       $des=$_POST['des'];
       $p_image= $_FILES['p_image']['name'];
       $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
       $p_image_folder_arrivals ='arrivals/'.$p_image;
       
       $check=mysqli_query($connect,"SELECT *FROM product WHERE prod_name='$name'");
       $error=array();
       if(empty($name)){
        $error['l']="Enter product name";
       }else if(empty($quantity)){
        $error['l']="upload an image";
       }else if(empty($price)){
        $error['l']="Enter product price";
       }else if(empty($des)){
        $error['l']="Enter something about the book";
       }
       
       
       else if(mysqli_num_rows($check)>0){
            $row=mysqli_fetch_assoc($check);
            $quantity=$quantity+$row['prod_qty'];
            $pid=$row['prod_id'];
        
            $add=mysqli_query($connect,"UPDATE product SET  prod_qty='$quantity',prod_des='$des',price='$price',prod_img='$p_image' WHERE prod_id='$pid'");
            if($add){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_arrivals);
                    $output.="<p class='success'>product add succesfully into folder_arrivals</p>";
                    header("Location:index.php");
            }
            else{
                $output.="<p class='success'>Failed to add product into folder_arrivals</p>";
            }
       }

       if(isset($error['l'])){
         $output.="<p class='alert'>".$error."</p>";
       }else{
        $output.="";
       }
       if(count($error)<=0 ){  
            $insert=mysqli_query($connect,"INSERT INTO product(prod_name ,prod_qty,prod_des,price,prod_img)
            VALUES('$name','$quantity','$des','$price','$p_image')") or die('query failed');

            if($insert){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_arrivals);
                    $output.="<p class='success'>product add succesfully into folder_arrivals</p>";  
                    header("Location:index.php");
            }
            else{
                $output.="<p class='success'>Failed to add product into folder_arrivals</p>";
            }
       }

    }
    ?>
</body>
</html>