<?php
require 'dbc.php';
session_start();

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
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body class="useradmins">
<?php 
if (isset($_GET['aId'])) {
    $aId = $_GET['aId'];
    $res=mysqli_query($connect,"SELECT * FROM user WHERE email='$aId';");
    $row2=mysqli_fetch_assoc($res);
}
    ?>
    <section class="viewAdmin">
        <div class="container">
            <div class="image">
                <img src="./images/user.png" alt="">
            </div>
            <div class="name">
                <h1><?php echo $row2['userName']; ?></h1>
            </div>
            <div class="email">
                <h2><?php echo $row2['email']; ?></h2>
            </div>
            <div class="number">
                <h3><?php echo $row2['phoneNumber']; ?></h3>
            </div>
            <div class="buttons">
                <div class="view-btn">
                    <a href="index.php" >Back</a>
                </div>
                <div class="delete-btn">
                    <a href="deleteAdmin.php?aId=<?php echo $row2['email']; ?>" >Delete</a>
                </div>
            </div>
        </div>
    </section>
    <div class="sub-topic">
        <h1>All Users</h1>
    </div>
    <section class="allAdmins">
        <?php    
            $res1=mysqli_query($connect,"SELECT * FROM user");
            while($row1=mysqli_fetch_assoc($res1)){
                if ($row1['email'] == $aId) {
                    continue;
                }
                   echo '<div class="container">
                   <div class="image">
                       <img src="219983.png" alt="">
                   </div>
                   <div class="name">
                       <h1>' . $row1['userName'] . '</h1>
                   </div>
                   <div class="email">
                       <h2>' . $row1['email'] . '</h2>
                   </div>
                   <div class="number">
                       <h3>' .$row1['phoneNumber'] . '</h3>
                   </div>
                   <div class="buttons">
                       <div class="view-btn">
                           <a href="viewUserDetails.php?aId=' . $row1['email'] . '"" >view</a>
                       </div>
                       <div class="delete-btn">
                           <a href="deleteAdmin.php?aId=' . $row1['email'] . '" >Delete</a>
                       </div>
                   </div>
               </div>
                   ';
                }
        ?>
    </section>
</body>
</html>