    <!--This script will check if the user is logged in, if not redirect to log in page -->
<?php
    require 'src/Accounts/log_in_check.php';
    session_start();

    $Shopping_cart = $con->prepare("SELECT user_id FROM CARTS WHERE user_id = ?");
    $Shopping_cart->bind_param("i", $_SESSION["user_id"]);
    $Shopping_cart->execute();
    $Shopping_cart->bind_result($Shopping_cart_exist);
    $Shopping_cart->fetch();
    $Shopping_cart->close();

    if($Shopping_cart_exist == 0){
        $query = $con->prepare("INSERT INTO CARTS (user_id) VALUES (?)"); 
        $query -> bind_param("i", $_SESSION["user_id"]);
        $query -> execute();
        $query->close();
        exit;
    }
?>