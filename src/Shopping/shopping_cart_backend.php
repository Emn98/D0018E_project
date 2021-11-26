<?php

    //1:Get all cart items assosciated with the users cart. 
    //2: Check of Total_price is empty then go trhough and add all cart items. 
    //3: If total price is not empyu then go through and check if a discount have been made and update the total price. 
    //4: Send the product array and total price to the frontend. 


    function retrive_cart_items(){

    

    session_start();

    //creates connection to database
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include_once($path);

    $cart_id =$_SESSION["cart_id"];

    //Fetch all cart items associated with the users cart.
    $query = $con->prepare("SELECT prodduct_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("s", $cart_id);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    return($result);
    }

?>