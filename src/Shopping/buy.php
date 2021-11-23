<?php
//require 'Accounts/log_in_check.php';
//require 'Shopping/check_shopping.php';
SESSSION_START();


if(isset($_POST[quantity])) {
    $quantity = $_POST['quantity'];

    //Checks the Database if the product already is in the cart
    $cart_product = $con->prepare("SELECT product_id FROM CART_ITEMS WHERE user_id = ?");
    $cart_product->bind_param("i", $_SESSION["user_id"]);
    $cart_product->execute();
    $cart_product->bind_result($product_in_cart);
    $cart_product->fetch();
    $cart_product->close();

    if($quantity > 0){
        if($product_in_cart != 0){ //If product is already in cart
            $new_quantity = $quantity + $product_in_cart;

            $query = $con->prepare("INSERT INTO CART_ITEMS (user_id, product_id, quantity) VALUES (?, ?, ?)"); 
            $query -> bind_param("iii", $_SESSION["user_id"], $product_id, $new_quantity);
            $query -> execute();
            $query->close();
        }else{
            $query = $con->prepare("INSERT INTO CART_ITEMS (cart_item_id, user_id, product_id, quantity) VALUES (?, ?, ?)"); 
            $query -> bind_param("iii", $_SESSION["user_id"], $product_id, $quantity);
            $query -> execute();
            $query->close();

        }

        echo "<div class='form'>
             <h3>Products Has Been Added To Cart.</h3><br/>
             <p class='link'>Click here to <a href='/Shopping/shopping_cart.php'>go to Cart</a>.</p>
             <p class='link'>Click here to <a href='/product_handling/product_details.php'>continue shopping</a>.</p>
             </div>";
    }

}else echo "No work :("

?>