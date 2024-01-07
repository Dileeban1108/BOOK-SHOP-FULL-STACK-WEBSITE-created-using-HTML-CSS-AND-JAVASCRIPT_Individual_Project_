<?php
require 'dbc.php';
session_start();

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
    $price=0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
   
    ?>
    <table border="solid">
        <thead>
            <tr>
                <td>product</td>
                <td>name</td>
                <td>price</td>
                <td>quantity</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
             <?php
                $select_user= mysqli_query($connect, "SELECT * FROM cart WHERE userId='$em'");
                $ckhselect_user=mysqli_num_rows($select_user);
                while($row1=mysqli_fetch_assoc($select_user)){
                    $product=$row1['productId'];
                    $select_prod= mysqli_query($connect, "SELECT * FROM product WHERE prod_id='$product'");
                    while($row2=mysqli_fetch_assoc($select_prod)){ 
                        $price+=$row2['price']*$row1['qty'];
                ?>
            <tr>
                <td>
                    <img src="arrivals/<?php echo $row2['prod_img']; ?>" alt=""><br>
                </td>
                <td>
                    <h1><?php echo $row2['prod_name']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo "$ ". $row2['price']; ?></h1><br>
                </td>
                <td>
                    <form action="updatesproduct.php" METHOD="POST">
                        <input type="hidden"  value="<?php  echo $row1['productId']?>" name="prodId">
                        <input  style="width: 20%; padding:.2rem;" type="text" name="qty" value="<?php echo $row1['qty'] ?>">
                        <button type="submit" name="submit">Update</button>
                    </form>
                </td>
                <td class="buttons">
                    <a href="deleteproduct.php?prId=<?php echo $row2['prod_id']; ?>" style="background: #ae260e;"href="">delete</a>
                </td>
            <?php
                }
            }
             ?>
            </tr>
        </tbody>
    </table>
    <div class="cprice">
        <div>
            <h1>Total</h1>  
        </div>
        <div>
            <h1>
                <?php 
                    if(isset($price)){
                        echo "$ ".$price;
                    }
                ?>
            </h1>
        </div>
        <div class="btns">
            <?php if($ckhselect_user>0) {
                echo '<a href="checkout.php">checkout</a>';
            }?>
            <a style="background: rgb(105, 103, 103);" href="index.php">Back</a>
        </div>        
    </div>
</body>

</html>