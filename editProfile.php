<?php
require 'dbc.php';
session_start();
$output="";

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
    <title>signup</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\demo.css">
    <link rel="stylesheet" href="phone-number-validation\build\css\intlTelInput.css">
</head>
<body>
<?php
    if(isset($_POST['submit'])){
        $useName = $_POST['un'];
        $phonenumber=$_POST['unmbr'];
        $Email = $_POST['uel'];
        $Password = md5($_POST['upwd']);
        $confirmpassword = md5($_POST['ucpwd']);
     
        $error = array();
        $checkemail = "SELECT * FROM user WHERE email='$Email';";
    
        // Execute SQL queries using a MySQLi connection ($connect should be defined)
        $result1 = mysqli_query($connect, $checkemail);
    
        $checkresult1 = mysqli_num_rows($result1);
    
    
        if (empty($useName)) {
            $error['l'] = "Enter your name";
        } else if (empty($Email)) {
            $error['l'] = "Enter your email";
        } else if (empty($Password)) {
            $error['l'] = "Enter your password";
        } else if (empty($phonenumber)) {
            $error['l'] = "Enetr your phone number";
        } else if ($checkresult1 > 0) {
            $error['l'] = "Email already exists";
        } else if ($Password !== $confirmpassword) {
            $error['l'] = "Passwords don't match";
        }
        if (isset($error['l'])) {
            $output .= "<p class='alert'>" . $error['l'] . "</p>";
        } else {
            $output .= " ";
        }
        
        if (count($error) < 1) {
        {
                // Perform the update only if the email is unique
                $sql = "UPDATE user SET userName='$useName',email='$Email',passwrd='$Password',phoneNumber='$phonenumber' WHERE email='$em'";
                $res = mysqli_query($connect, $sql);
                if($res){
                    $_SESSION['new_user']=$Email;
                    header("Location:index.php?UPDATE=SUCCESS");
                } else {
                    // Display an error message or handle the update failure
                    $output .= "<p class='alert'>Error updating the user profile</p>";
                }
            } 
        }
    }
    ?>
    <div class="profile_section">
        <div class="profile">
            <div class="image">
                <img src="219983.png" alt="">
            </div>
            <div class="name">
                <h1><?php echo $row['userName']; ?></h1>
            </div>
            <div class="email">
                <h2><?php echo $row['email']; ?></h2>
            </div>
            <div class="number">
                <h3><?php echo $row['phoneNumber']; ?></h3>
            </div>
        </div>
        <div class="update_form">
            <h3>Update product</h3>
            <?php
                    echo $output;      
            ?>
            <form action="editProfile.php" method="POST">
                <div>
                <input type="text" placeholder="<?php echo "Name [ ex : " .$row['userName']. " ]"?>"  name="un">
                </div>
                <div>
                    <input type="email" placeholder="<?php  echo "Email [ ex : " .$row['email']. " ]" ?>"  name="uel">
                </div>
                <div>
                    <input type="tel" min="0" max="10" placeholder="<?php echo "Phone number [ ex : " . $row['phoneNumber']. " ]" ?>"  name="unmbr">
                </div>
                <!-- <div>
                    <input type="password" placeholder="Old password" name="opwd">
                </div> -->
                <div>
                    <input type="password" placeholder="New password" name="upwd">
                </div>
                <div>
                    <input type="password" placeholder="Confirm new password" name="ucpwd">
                </div>
                <div class="submit">
                    <input type="submit" value="Update" name="submit">
                </div>
            </form>
            <div class="home">
                    <a href="index.php">Home</a>
            </div>
        </div>
    </div>
        
    
    
    <script src="phone-number-validation\build\js\intlTelInput.js"></script>
    <script>
        var input=document.querySelector('#phone');
        window.intlTelInput(input,{});
    </script>
</body>
</html>