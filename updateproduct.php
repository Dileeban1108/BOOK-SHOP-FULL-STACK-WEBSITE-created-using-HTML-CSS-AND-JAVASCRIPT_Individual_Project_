<?php
require 'dbc.php';
session_start();
$output = "";

if (isset($_SESSION['new_user'])) {
    $em = $_SESSION['new_user'];
    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$em';");
    $row = mysqli_fetch_assoc($sql);
    if (!mysqli_num_rows($sql) > 0) {
        header("Location: home.php");
    }
} else {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="phone-number-validation/build/css/demo.css">
    <link rel="stylesheet" href="phone-number-validation/build/css/intlTelInput.css">
    <link rel="stylesheet" href="style2.css">
    <style>
        .file-upload {
            display: none;
        }

        .upload-button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['pId'])) {
        $pId = $_GET['pId'];
        $select_product = mysqli_query($connect, "SELECT * FROM product WHERE prod_id='$pId'");
        $row1 = mysqli_fetch_assoc($select_product);
    }
    ?>
    <div class="product_section">
        <div class="products">
            <?php if (isset($row1)) { ?>
                <div class="image">
                    <img src="arrivals/<?php echo htmlspecialchars($row1['prod_img']); ?>" alt="">
                </div>
                <div class="name" >
                    <h1><?php echo htmlspecialchars($row1['prod_name']); ?></h1>
                </div>
                <div class="price">
                    <h2><?php echo htmlspecialchars($row1['price']); ?></h2>
                </div>
                <div class="qty">
                    <h3><?php echo htmlspecialchars($row1['prod_qty']); ?></h3>
                </div>
                <div class="des">
                    <h3><?php echo htmlspecialchars($row1['prod_des']); ?></h3>
                </div>
            <?php } ?>
        </div>
        <div class="update_form">
            <h3>Update Product</h3>
            <?php
            if (isset($output)) {
                echo $output;
            }
            ?>
            <form action="updateproduct.php?pId=<?php echo htmlspecialchars($pId); ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="pimg" class="upload-button">Upload Your Image</label>
                    <input type="file" placeholder="Upload a new image" accept="image/png, image/jpg, image/jpeg" name="pimg" id="pimg" class="file-upload">
                </div>
                <div>
                    <input type="text" value="<?php echo htmlspecialchars($row1['prod_name']); ?>" placeholder="Name" name="pn">
                </div>
                <div>
                    <input type="text" value="<?php echo htmlspecialchars($row1['price']); ?>" placeholder="Price" name="pp">
                </div>
                <div>
                    <input type="number" min="0" value="<?php echo htmlspecialchars($row1['prod_qty']); ?>" placeholder="Quantity" name="pqty">
                </div>
                <div>
                    <input type="text" value="<?php echo htmlspecialchars($row1['prod_des']); ?>" placeholder="Description" name="pd">
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
    <?php
    if (isset($_POST['submit'])) {
        $prodName = $_POST['pn'];
        $price = $_POST['pp'];
        $qty = $_POST['pqty'];
        $des = $_POST['pd'];
        $error = array();

        if (empty($prodName)) {
            $error['l'] = "Enter product name";
        } else if (empty($price)) {
            $error['l'] = "Enter product price";
        } else if (empty($qty)) {
            $error['l'] = "Enter product quantity";
        } else if (empty($des)) {
            $error['l'] = "Enter product description";
        }

        if (isset($error['l'])) {
            $output .= "<p class='alert'>" . htmlspecialchars($error['l']) . "</p>";
        } else {
            $output .= " ";
        }

        if (count($error) < 1) {
            $pId = $_GET['pId'];
            $sql1 = "UPDATE product SET prod_name='$prodName', prod_des='$des', prod_qty='$qty', price='$price' WHERE prod_id='$pId'";
            $res = mysqli_query($connect, $sql1);
            if ($res) {
                if (isset($_FILES['pimg']) && !empty($_FILES['pimg']['name'])) {
                    $p_image = $_FILES['pimg']['name'];
                    $p_image_tmp_name = $_FILES['pimg']['tmp_name'];
                    $p_image_folder_arrivals = 'arrivals/' . $p_image;
                    move_uploaded_file($p_image_tmp_name, $p_image_folder_arrivals);
                    $update_img_sql = "UPDATE product SET prod_img='$p_image' WHERE prod_id='$pId'";
                    mysqli_query($connect, $update_img_sql);
                    $output .= "<p class='success'>Product image updated successfully</p>";
                }
                header("Location: index.php");
            } else {
                $output .= "<p class='alert'>Error updating the product</p>";
            }
        }
    }
    ?>
    <script src="phone-number-validation/build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector('#phone');
        window.intlTelInput(input, {});
    </script>
</body>

</html>