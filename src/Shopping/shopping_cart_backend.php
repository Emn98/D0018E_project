<?php

    session_start();

    //creates connection to database
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include_once($path);

    $cart_id =$_SESSION["cart_id"];

    //Fetch all cart items associated with the users cart.
    $query = $con->prepare("SELECT prodduct_id AND quantity FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("s", $cart_id);
    $query->execute();
    $result = $query->get_result();
    $query->close();

   
?>