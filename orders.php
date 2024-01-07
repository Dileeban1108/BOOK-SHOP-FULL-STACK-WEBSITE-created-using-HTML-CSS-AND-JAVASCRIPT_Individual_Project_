<?php
require 'dbc.php';
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
    $output = "";  // Initialize the $output variable

    if(isset($_POST['submit'])){
        $uId=$_POST['uId'];
        $fn=$_POST['fname'];
        $em=$_POST['email'];
        $pn=$_POST['pn'];
        $as=$_POST['address'];
        $cy=$_POST['city'];
        $se=$_POST['state'];
        $zp=$_POST['zip'];
        $cn=$_POST['cardname'];
        $cnmbr=$_POST['cardnumber'];
        $ey=$_POST['expyear'];
        $cvv=$_POST['cvv'];
        $pc=$_POST['price'];
        $error = array();

        if (empty($as)) {
            $error['l'] = "Enter your adress";
        } else if (empty($cy)) {
            $error['l'] = "Enter your city";
        } else if (empty($se)) {
            $error['l'] = "Enter your state";
        } else if (empty($zp)) {
            $error['l'] = "Enetr the zip code";
        }else if (empty($cn)) {
            $error['l'] = "Enter your card name";
        } else if (empty($cnmbr)) {
            $error['l'] = "Enter your card number";
        }else if (empty($ey)) {
            $error['l'] = "Enetr expired year";
        } else if (empty($cvv)) {
            $error['l'] = "Enetr cvv number";
        }
        if (isset($error['l'])) {
            $output .= "<p class='alert'>" . $error['l'] . "</p>";
        } else {
            $output .= " ";
        }
        if (count($error) < 1) {
            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO orders (userName, email, phoneNumber,adress,city,state,zipCode,price) VALUES 
                                    ('$fn', '$em', '$pn','$as','$cy','$se','$zp','$pc')";
            $res = mysqli_query($connect, $sql);
            if ($res) {
                $output .= "<p class='success'>You have added a new order</p>";
                header("Location:index.php?SIGNUP=SUCCESS");
            } else {
                $output .= "<p class='alert'>Failed to add a new user</p>";
            }
        }
        
    }
    ?>
</body>
</html>