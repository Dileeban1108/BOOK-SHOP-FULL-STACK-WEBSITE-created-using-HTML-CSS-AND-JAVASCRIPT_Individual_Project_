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
$price=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>
<?php
      $select_user= mysqli_query($connect, "SELECT * FROM cart WHERE userId='$em'");
      while($row=mysqli_fetch_assoc($select_user)){
          $product=$row['productId'];
          $select_prod= mysqli_query($connect, "SELECT * FROM product WHERE prod_id='$product'");
          while($row5=mysqli_fetch_assoc($select_prod)){ 
              $price+=$row5['price']*$row['qty'];
          }}?>
<div class="row">
  <div class="col-75">
    <div class="container">
       <?php
           include 'orders.php';
           echo $output;
        ?>
      <form action="checkout.php" method="POST">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <input type="hidden" value="<?php $em ?>" name="uId">
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fname" value="<?php echo $row2['userName'] ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?php echo $row2['email'] ?>">
            <label for="pn"><i class="fa fa-phone"></i> Phone Number</label>
            <input type="text" id="pn" name="pn" value="<?php echo $row2['phoneNumber'] ?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Adress">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="city">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip code</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text"  name="cardname" placeholder="VISA / MASTER CARD">
            <label for="ccnum">Credit card number</label>
            <input type="text"  name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <select name="emnth">
                <option value="january">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
       
        <input type="hidden" value="<?php echo $price ?>" name="price">
        <input type="submit" value="continue" class="btn" name="submit">

      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Cart
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
        </span>
      </h4>
      <div class="cart">
        <?php if($row5){?>
        <h3><?php echo $row5['prod_name'] ?></h3> 
        <h6><?php echo "$ ".$row5['price']*$row['qty']?></h6>
        <?php }?>
      </div>
      <hr>
      <p class="total">Total <span><?php echo "$ " .$price ?></span></p>
    </div>
    <div class="backcart">
       <a href="cart.php">Back to cart</a>
    </div>
  </div>
</div>
</body>
</html>
