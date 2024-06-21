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
    <table border="solid">
        <thead>
            <tr>
                <td>User Name</td>
                <td>Email</td>
                <td>Phone number</td>
                <td>Adress</td>
                <td>City</td>
                <td>State</td>
                <td>ZipCode</td>
                <td>Total Price</td>
            </tr>
        </thead>
        <tbody>
             <?php
                $select_user= mysqli_query($connect, "SELECT * FROM orders");
                    while($row2=mysqli_fetch_assoc($select_user)){ ?>
             <tr>
                <td>
                <h1><?php echo $row2['userName']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo $row2['email']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo $row2['phoneNumber']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo  $row2['adress']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo  $row2['city']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo  $row2['state']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo  $row2['zipCode']; ?></h1><br>
                </td>
                <td>
                    <h1><?php echo "$ ". $row2['price']; ?></h1><br>
                </td>
                <td class="obuttons">
                <a href="#" onclick="alert('Message sent to the user')">Confirm</a>
                </td>
            <?php
                }
            ?>
            </tr>
        </tbody>
    </table>
</body>

</html>