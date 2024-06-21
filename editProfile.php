<?php
require 'dbc.php';
session_start();
$output = "";

if (isset($_SESSION['new_user'])) {
    $em = $_SESSION['new_user'];
    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$em';");
    $row = mysqli_fetch_assoc($sql);
    if (!mysqli_num_rows($sql) > 0) {
        header("Location:home.php");
    }
} else {
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="phone-number-validation/build/css/demo.css">
    <link rel="stylesheet" href="phone-number-validation/build/css/intlTelInput.css">
</head>

<body >
    <?php
    if (isset($_POST['submit'])) {
        $useName = $_POST['un'];
        $phonenumber = $_POST['unmbr'];
        $Password = md5($_POST['upwd']);
        $confirmpassword = md5($_POST['ucpwd']);

        $error = array();

        if (empty($useName)) {
            $error['l'] = "Enter your name";
        } else if (empty($Password)) {
            $error['l'] = "Enter your password";
        } else if (empty($phonenumber)) {
            $error['l'] = "Enter your phone number";
        } else if ($Password !== $confirmpassword) {
            $error['l'] = "Passwords don't match";
        }
        if (isset($error['l'])) {
            $output .= "<p class='alert'>" . $error['l'] . "</p>";
        } else {
            $output .= " ";
        }

        if (count($error) < 1) {
            // Perform the update only if no errors
            $sql = "UPDATE user SET userName='$useName', passwrd='$Password', phoneNumber='$phonenumber' WHERE email='$em'";
            $res = mysqli_query($connect, $sql);
            if ($res) {
                header("Location:index.php?UPDATE=SUCCESS");
            } else {
                // Display an error message or handle the update failure
                $output .= "<p class='alert'>Error updating the user profile</p>";
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
            <h3>Update Profile</h3>
            <?php echo $output; ?>
            <form action="editProfile.php" method="POST">
                <div class="input-text">
                    <input type="text" value="<?php echo $row['userName']; ?>" placeholder="Name" name="un">
                </div>
                <div class="input-text">
                    <input type="email" value="<?php echo $row['email']; ?>" placeholder="Email" name="uel" readonly>
                </div>
                <div class="input-text">
                    <input type="tel" value="<?php echo $row['phoneNumber']; ?>" placeholder="Phone number" name="unmbr">
                </div>
                <div class="input-text">
                    <input type="password" placeholder="New password" name="upwd">
                </div>
                <div class="input-text">
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
    <script src="phone-number-validation/build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector('#phone');
        window.intlTelInput(input, {});
    </script>
</body>

</html>