<?php
require 'dbc.php';
session_start();



if (isset($_SESSION['new_user'])) {
    $em = $_SESSION['new_user'];
    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$em';");
    $row2 = mysqli_fetch_assoc($sql);
    if (!mysqli_num_rows($sql) > 0) {
        header("Location:home.php");
    }
} else {
    header("Location:home.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:home.php");
}
if (!isset($_SESSION['cart_count'])) {
    $_SESSION['cart_count'] = 0;
}

$qty = 1;

if (isset($_GET['pId'])) {
    $pId = $_GET['pId'];
    $checkProductQuery = mysqli_query($connect, "SELECT * FROM cart WHERE userId='$em' AND productId='$pId'");
    if (!mysqli_num_rows($checkProductQuery) > 0) {
        mysqli_query($connect, "INSERT INTO cart (userId, productId, qty) VALUES ('$em','$pId','$qty')");
        $_SESSION['cart_count']++;  // Increment the cart count
        echo '<script>
        alert("added to cart successfully");
        window.location.href = "index.php";
        </script>';
    } else {
        echo '<script>
        alert("already added to the cart");
        window.location.href = "index.php";
        </script>';
    }
}

$count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ABC Private Limited</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <?php
        if (isset($_SESSION['new_user'])) {
            $ue = $_SESSION['new_user'];
            $result = mysqli_query($connect, "SELECT * FROM superadmin WHERE email='$ue'");
            $result1 = mysqli_query($connect, "SELECT * FROM  admi WHERE email='$ue'");
            $res = mysqli_query($connect, "SELECT * FROM admi");
            $chkresult = mysqli_num_rows($result);
            $chkresult1 = mysqli_num_rows($result1);
        }
        ?>
        <div class="logo" style=" font-size:x-large; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; border: solid;">ABC</div>
        <div id="menu-bar">l></div>
        <nav class="navbar">
            <a href="#popular" class="active">home</a>
            <a href="#reveiw">customer reviews</a>
            <?php
            if ($chkresult || $chkresult1) {
                echo '<a href="vieworders.php">view orders</a>';
            }
            if (!$chkresult || !$chkresult1) {
                echo '<a href="cart.php">' . $count . '<i class="bx bxs-cart"></i></a>';
            }
            ?>


        </nav>
        <a href="#" class="signuplogo" onclick="toggleMenu2()">
            <img src="./images/user.png">
        </a>
        <div class="sub-menu-wrap" id="subMenu2">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="./images/user.png">
                    <div class="texts">
                        <h2><?php echo $row2['userName']; ?></h2>
                        <h3><?php echo $row2['email']; ?></h3>
                    </div>
                </div>
                <hr>

                <a href="editProfile.php">
                    <img src="./images/user-circle-solid-24.png" alt="">
                    <p>Edit Profile</p>
                    <span>></span>
                </a>
               
                <?php
                if ($chkresult1 > 0) {
                    if ($chkresult > 0) {
                        echo '<a href="addadmin.php">
                                        <img src="./images/user-circle-solid-24.png" alt="">
                                        <p>Add admins</p>
                                        <span>></span>
                                      </a>
                                <a href="#" onclick="toggleMenu()">
                                        <img src="./images/user-circle-solid-24.png" alt="">
                                        <p>View admins</p>
                                        <span>></span>
                                </a>';
                    }
                    echo '<a href="#" onclick="toggleMenu3()">
                                        <img src="./images/user-circle-solid-24.png" alt="">
                                        <p>View users</p>
                                        <span>></span>
                                </a>';
                }
                ?>
               
                <a href="index.php?logout" class='logoutbtn'>
                    <img src="./images/horizontal-right-regular-24.png" alt="">
                    <p>Logout</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </header>
    <section class="main">
        <div class="viewAdmins" id="subMenu">
            <div class="sub">
                <div class="cancel">
                    <div class="topic">
                        <h1>Admin list</h1>
                    </div>
                    <div class="icon" onclick="cancelMenu()">
                        x
                    </div>
                </div>
                <?php
                $result1 = mysqli_query($connect, "SELECT * FROM user WHERE email='$ue'");
                while ($row = mysqli_fetch_assoc($res)) {
                    $row1 = mysqli_fetch_assoc($result1);
                    if ($row && !$row1) {
                        echo '<div class="con">
                            <div class="name">
                            ' . $row['userName'] . '<br>
                            </div>
                            <div class="view">
                                <a href="viewAdminDetails.php?aId=' . $row['email'] . '">view</a>
                            </div>
                    </div>
                    <hr>
                    ';
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <section class="main">
        <div class="viewUsers" id="subMenu3">
            <div class="sub">
                <div class="cancel">
                    <div class="topic">
                        <h1>Users list</h1>
                    </div>
                    <div class="icon" onclick="cancelMenu()">
                        x
                    </div>
                </div>
                <?php
                $result1 = mysqli_query($connect, "SELECT * FROM user WHERE email='$ue'");
                $res3 = mysqli_query($connect, "SELECT * FROM user");
                while ($row5 = mysqli_fetch_assoc($res3)) {
                    $row6 = mysqli_fetch_assoc($result1);
                    if ($row5 && !$row6) {
                        echo '<div class="con">
                            <div class="name">
                            ' . $row5['userName'] . '<br>
                            </div>
                            <div class="view">
                                <a href="viewUserDetails.php?aId=' . $row5['email'] . '">view</a>
                            </div>
                    </div>
                    <hr>
                    ';
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <section class="popular" id="popular">
        <h1 class="heading"> <span> PRODUCT</span> COLLECTIONS</h1>
        <div class="box-container">
            <?php
            if (isset($_SESSION['new_user'])) {
                $ue = $_SESSION['new_user'];
                $result1 = "SELECT * FROM admi WHERE email='$ue';";
                $result2 = "SELECT * FROM superadmin WHERE email='$ue';";
                $chkresult1 = mysqli_query($connect, $result1);
                $chkresult2 = mysqli_query($connect, $result2);
                $row3 = mysqli_fetch_assoc($chkresult1);
                $row4 = mysqli_fetch_assoc($chkresult2);

                if (mysqli_num_rows($chkresult1) > 0 ||  mysqli_num_rows($chkresult2) > 0) {
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
            if (mysqli_num_rows($select_products) > 0) {
                while ($row1 = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <img src="arrivals/<?php echo $row1['prod_img']; ?>" alt="">
                        <h3><?php echo $row1['prod_name']; ?></h3>
                        <div class="overlay">
                            <h1><?php echo "$ " . $row1['price'] ?></h1>
                            <p><?php echo $row1['prod_des'] ?></p>
                        </div>
                        <?php
                        if (mysqli_num_rows($chkresult1) > 0 ||  mysqli_num_rows($chkresult2) > 0) {
                            echo '<div class="update">
                 <a href="updateproduct.php? pId= ' . $row1['prod_id'] . '">Update</a>
                 
              </div>';
                        } else {
                            echo '<div class="buttons">
            <div class="cart">
                <a href="index.php?pId=' . $row1['prod_id'] . '">Add to cart</a>
            </div>
            <div class="buy">
                <a href="checkout.php?pId=' . $row1['prod_id'] . '">Buy now</a>
            </div>
        </div>';
                        } ?>
                    </div>
            <?php
                }
            } else {
                echo "<div class='empty'>no product added</div>";
            };
            ?>
        </div>
        </div>
    </section>

    <section class="reveiw" id="reveiw" style="border:none;">
        <h1 class="heading"><span>CUSTOMER</span> REVIEWS</h1>
        <div class="addingReview">
            <form action="addreview.php" method="POST" enctype="multipart/form-data">
                <div>
                    <input type="hidden" value="<?php echo $row2['userName'] ?>" name="rn">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Add your review here " name="des">
                </div>
                <div class="button" >
                    <input style="color: white;" type="submit" value="Add" name="submit">
                </div>
            </form>
        </div>
        <div class="box-container">
            <?php
            $select_reviews = mysqli_query($connect, "SELECT * FROM review ORDER BY rId desc");
            if (mysqli_num_rows($select_reviews) > 0) {
                while ($row8 = mysqli_fetch_assoc($select_reviews)) {
            ?>
                    <div class="box">
                        <img src="images\customers.png" alt="">
                        <h3> <?php echo $row8['reviewerName']; ?></h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="content">
                            <p> <?php echo $row8['review'] ?></p>
                        </div>
                        <?php
                        if (isset($row3['userName']) || isset($row4['userName'])) {
                            if ($row3['userName'] || $row4['userName']) {
                                echo '<a href="delete_review.php?rId=' . $row8['rId'] . '">delete</a>';
                            }
                        } else if (isset($row8['reviewerName'])) {
                            if ($row8['reviewerName'] == $row2['userName']) {
                                echo '<a href="delete_review.php?rId=' . $row8['rId'] . '">delete</a>';
                            }
                        }
                        ?>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <section class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>Welcome to our bookshop. We offer a wide range of books across various genres to cater to all book lovers. Our mission is to promote reading and provide the best books at affordable prices.</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#reveiw">Review</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: info@bookshop.com</p>
                <p>Phone: +123 456 789</p>
                <p>Address: 123 Bookshop St, Book City, BK 10001</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 Bookshop | Designed by YourName
        </div>
    </section>
    <script src="script.js">
    </script>
    <script>
        let sub = document.getElementById('subMenu');

        function toggleMenu() {
            sub.style.display = 'initial';
        }
        let sub3 = document.getElementById('subMenu3');

        function toggleMenu3() {
            sub3.style.display = 'initial';
        }

        let sub2 = document.getElementById('subMenu2');

        function toggleMenu2() {
            sub2.classList.toggle("opendiv");
        }

        function cancelMenu() {
            sub.style.display = 'none';
            sub3.style.display = 'none';
        }
        let viewAdmin = document.getElementbyId('viewAdmin');

        function openMenu() {
            sub.style.display = viewAdmin;
        }
    </script>

</body>

</html>