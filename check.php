<?php
require 'dbc.php';
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
$output = "";

if (isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = md5($_POST['password']);

    // Assuming $connect is your database connection
    $checkemail = "SELECT * FROM user WHERE email='$Email'";
    $result1 = mysqli_query($connect, $checkemail);

    if ($result1) {
        $checkresult1 = mysqli_num_rows($result1);

        if ($checkresult1 > 0) {
            $row = mysqli_fetch_assoc($result1);
            $error = array();

            if (empty($Email)) {
                $error['l'] = "Enter your email";
            } else if (empty($Password)) {
                $error['l'] = "Enter your password";
            } else if ($row['passwrd'] != $Password) {
                $error['l'] = "Enter correct password";
            }

            if (isset($error['l'])) {
                $output .= "<p class='alert'>" . $error['l'] . "</p>";
            } else {
                $output .= " ";
            }

            if (count($error) < 1) {
                if ($Email == " SELECT email FROM admi where passwrd='$Password' AND email='$Email';") {
                    $output .= "<p class='success'>Successfully logged in as admin</p>";
                } else {
                    $output .= "<p class='success'>Successfully logged in as user</p>";

                }
                $_SESSION['new_user']=$Email;
                header("Location:index.php?LOGIN=SUCCESSFULL");
                
            }
        } else {
            $output .= "<p class='alert'>No user found with the provided email</p>";
        }
    } //else {
    //    $output .= "<p class='alert'>Error in the SQL query: " . mysqli_error($connect) . "</p>";
    // }
}
?>

</body>
</html>