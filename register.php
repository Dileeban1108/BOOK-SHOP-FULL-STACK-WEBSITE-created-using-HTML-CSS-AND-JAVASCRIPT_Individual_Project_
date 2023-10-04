<?php
session_start();
require 'dbc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
    <style>
    .alert {
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ff0000;
        color: #ff0000;
        background-color: #ffcccc;
        border-radius: 5px;
        position: relative;
        top: 8px;
    }

    .success {
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #008000;
        color: #008000;
        background-color: #ccffcc;
        border-radius: 5px;
        position: relative;
        top: 8px;
    }
</style>

</head>
<body>
<?php
$output = "";  // Initialize the $output variable

if (isset($_POST['submit'])) {
    $useName = $_POST['fn'];
    $phonenumber=$_POST['number'];
    $Email = $_POST['el'];
    $Password = md5($_POST['pwd']);
    $confirmpassword = md5($_POST['cpwd']);


    // Check if email or username already exist
    $checkemail = "SELECT * FROM user WHERE email='$Email';";
    $checkname = "SELECT * FROM user WHERE userName='$useName';";

    // Execute SQL queries using a MySQLi connection ($connect should be defined)
    $result1 = mysqli_query($connect, $checkemail);
    $result2 = mysqli_query($connect, $checkname);

    $checkresult1 = mysqli_num_rows($result1);
    $checkresult2 = mysqli_num_rows($result2);

    $error = array();

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
    } else if ($checkresult2 > 0) {
        $error['l'] = "Username already exists";
    } else if ($Password !== $confirmpassword) {
        $error['l'] = "Passwords don't match";
    }

    if (isset($error['l'])) {
        $output .= "<p class='alert'>" . $error['l'] . "</p>";
    } else {
        $output .= " ";
    }

    if (count($error) < 1) {
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO user (userName, email, passwrd,phoneNumber) VALUES ('$useName', '$Email', '$Password','$phonenumber')";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $output .= "<p class='success'>You have added a new user</p>";
            $_SESSION['new_user']=$Email;
            header("Location:index.php?SIGNUP=SUCCESS");
        } else {
            $output .= "<p class='alert'>Failed to add a new user</p>";
        }
    }
}
?>

</body>
</html>

