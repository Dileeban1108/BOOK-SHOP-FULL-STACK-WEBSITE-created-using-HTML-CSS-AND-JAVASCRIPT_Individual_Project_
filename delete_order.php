<?php
require 'dbc.php';
session_start();

if(isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $delete_query = "DELETE FROM orders WHERE id='$orderId'";
    $delete_result = mysqli_query($connect, $delete_query);

    if($delete_result) {
        header("Location: vieworders.php?message=Order deleted successfully");
    } else {
        header("Location: vieworders.php?error=Failed to delete order");
    }
} else {
    header("Location: vieworders.php");
}
?>