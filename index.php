<?php
session_start();
if(isset($_SESSION['new_user'])){
    $i=$_SESSION['new_user'];
}
require 'dbc.php';

if(isset($_GET['logout'])){
    session_destroy();
}

if(isset($_SESSION['new_user'])){
    $em=$_SESSION['new_user'];  
    $sql=mysqli_query($connect,"SELECT * FROM user WHERE email='$em';");
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
    <title> ABC Private Limited</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo" style=" font-size:x-large; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; border: solid;">ABC</div>
            <div id="menu-bar" class="fas fa-bars"></div>
            <nav class="navbar">
                <a href="#popular" class="active">home</a>
                <a href="#reveiw">customer reviews</a>
                <?php
    if(isset($_SESSION['new_user'])){
        $ue=$_SESSION['new_user'];
        $result=mysqli_query($connect,"SELECT *FROM superadmin WHERE email='$ue'");
        $chkresult=mysqli_num_rows($result);
        if($chkresult>0){
            echo "<a href='addadmin.php'><i class='bx bx-user-plus'></i>add admin</a>";
        }
           
    }?>
            </nav>
            <div class="signuplogo">
                 <a href="login.php"><i>Log In</i></a>                
            </div>
    </header>
    <section class="popular" id="popular">
        <h1 class="heading"> <span> PRODUCT</span> COLLECTIONS</h1>
        <div class="box-container">
            <?php
            if(isset($_SESSION['new_user'])){
                $ue=$_SESSION['new_user'];
                $result1="SELECT * FROM admi WHERE email='$ue';";
                $result2="SELECT * FROM superadmin WHERE email='$ue';";
                $chkresult1=mysqli_query($connect,$result1);
                $chkresult2=mysqli_query($connect,$result2);

                if(mysqli_num_rows($chkresult1)>0 ||  mysqli_num_rows($chkresult2)>0){
                    echo '<div class="box" style="background-color: rgba(180, 180, 180, 0.326);">
                    <a href="products.php"><img class="plus" style=" position:relative; top:15px; padding:30px;"src="images\plus.png" alt=""></a>
                    <h1 style="color:gray; font-size:2.5rem;">add books</h1>
                    <div class="stars">
                        
                    </div>
                    <div class="">
                        <p></p>
                        <a href="" class=""></a>
                    </div>
                </div>';
               }
            }

            ?>
                <?php
    $select_products = mysqli_query($connect, "SELECT * FROM product ORDER BY prod_id desc");
    if(mysqli_num_rows($select_products) > 0){
        while($row = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="box">
        <img src="arrivals/<?php echo $row['prod_img']; ?>" alt="">
        <h3><?php echo $row['prod_name']; ?></h3>
        <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
        </div>
        <div class="content">
            <p><?php echo $row['prod_des']; ?></p>
            <h1 >$<?php echo $row['price']; ?>.00</h1>
            <a href="" class="btn">buy now</a>
        </div>
    </div>
    <?php
        };    
    } else {
        echo "<div class='empty'>no product added</div>";
    };
    ?>
</div>
        </div>
    </section>
    <section class="reveiw" id="reveiw">
        <h1 class="heading"> CUSTOMER<span> REVIEWS</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="images\customers.png" alt="">
                <h3>Ashen rashmika</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>this is the best app I have ever used.because all book are herehighly recomended</p>
            </div>
            <div class="box">
                <img src="images\customers.png" alt="">
                <h3>shashinda</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>good job.one of best app collection.love it</p>
            </div>
            <div class="box">
                <img src="images\customers.png" alt="">
                <h3>sadeep fernando</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>very fast app.i can easyly handle it.recomended</p>
            </div>
            
            <div class="box">
                <img src="images\customers.png" alt="">
                <h3>peheliya dhanuka</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>nice.good job,highly recomended</p>
            </div>
        </div>
      </section>
    <script src="script.js"></script>
  </body>  
</html>