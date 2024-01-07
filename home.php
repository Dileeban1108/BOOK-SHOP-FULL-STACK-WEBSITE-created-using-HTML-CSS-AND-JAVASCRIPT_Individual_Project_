<?php
require 'dbc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ABC Private Limited</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @media(max-width:768px){
        .reveiw .box-container .box{
            width: 40%;
        }
        
        }
        @media(max-width:576px){
        .reveiw .box-container .box{
            width: 100%;
        }

        }
    </style>
</head>
<body>
    <header>
            <div class="logo" style=" font-size:x-large; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; border: solid;">
                ABC
            </div>
            <div id="menu-bar" class="fas fa-bars"></div>
            <nav class="navbar">
                <a href="#home" class="active">home</a>
                <a href="#reveiw">customer reviews</a>
            </nav>
            <div class="logintext">
                 <a href="login.php">Log In</a>                
            </div>
    </header>
    <section class="home" style="padding-top: 8rem;" id="home">
        <div class="home-contents" style=" display:flex; flex-wrap:wrap; justify-content: space-between; margin: 5px; padding: 8px;">
            <div>
                <h1 style="font-size: 9.5rem; color:green; text-shadow:0 .6rem .1rem black ;">
                    GET  
                </h1>
                <h1 style="font-size: 9.5rem; color:red; text-shadow: 0 .2rem 2rem gold;">
                    BEST
                </h1>
                <h1 style="font-size: 9.5rem; color:green; text-shadow:0 .6rem .1rem black ;">
                    THINGS
                </h1>
                <h1 style="font-size:9rem; color:green; text-shadow:0 .6rem .1rem black ; padding-top:10px">
                    IN <span style="color:red; text-shadow: 0 .2rem 2rem gold;">LEAST</span> PRICE
                </h1>
            </div>
            <div>
               <h1 style="font-size: 9.5rem; color:green; text-shadow:0 .5rem .1rem black ;">
                <span style="color:red; text-shadow: 0 .2rem 2rem gold;">25%</span> discount
               </h1>
               <h3 style="font-size: 4.5rem; color:red; text-shadow:0 .8rem 5rem gold ;padding-top:10px ;">
                FOR EVERY PRODUCT
               </h3>
            </div>
        </div>
    </section> 
    <section class="reveiw" id="reveiw">
        <h1 class="heading"> CUSTOMER<span> REVIEWS</span></h1>
        <div class="box-container">
        <?php
    $select_products = mysqli_query($connect, "SELECT * FROM review ORDER BY rId desc");
    if(mysqli_num_rows($select_products) > 0){
        while($row = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="box">
        <img src="images\customers.png" alt="">
        <h3><?php echo $row['reviewerName']; ?></h3>
        <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
        </div>
        <div class="content">
            <p><?php echo $row['review']; ?></p>
        </div>
    </div>
    <?php
        };    
    };
    ?>
</div>
        </div>
      </section>
  </body>  
</html>