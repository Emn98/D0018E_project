<?php

    //1:Get all cart items assosciated with the users cart. 
    //2: Check of Total_price is empty then go trhough and add all cart items. 
    //3: If total price is not empyu then go through and check if a discount have been made and update the total price. 
    //4: Send the product array and total price to the frontend. 


    function update_shopping_cart_total(){
        if(gettype($_SESSION["cart_id"]) != NULL && isset($_SESSION["cart_id"])){

          session_start();

          //Connect to database
          $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

            //Retrive all items associated with the logged in users cart. 
            $query = $con->prepare("SELECT product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
            $query->bind_param("i", $cart_id);
            $query->execute();
            $result = $query->get_result();
            $query->fetch();
            $query->close();

            $calc_total_price = 0;

            while ($row = $result->fetch_assoc()) {
                $query = $con->prepare("SELECT price, discount FROM PRODUCTS WHERE product_id=?");
                $query->bind_param("i", $row["product_id"]);
                $query->execute();
                $query->bind_result($product_price, $product_discount);
                $query->fetch();
                $query->close();

                $calc_total_price = $calc_total_price + ($row["quantity"]*($product_price*(1-$product_discount)));
            }

            $query = $con->prepare("UPDATE CARTS SET total_price=? WHERE cart_id=?");
            $query -> bind_param("iii", $calc_total_price, $cart_id);
            $query -> execute();
            $query->close();
        }
    }
?>