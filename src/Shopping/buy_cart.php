<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

//Check so the user have a cart. 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Shopping/check_if_user_have_order.php";
require($path);

include("update_shopping_cart.php");
include("buy_cart_methods.php");

if(!$cart_is_empty){
  $cart_id = $_SESSION["cart_id"];
  $user_id = $_SESSION["user_id"];
  $order_id = $_SESSION["order_id"];

  
  /* Start transaction */
mysqli_begin_transaction($con);

try { 
    update_shopping_cart_total($con);

    $result = get_product_info_cart_items($con, $cart_id);

    //Fix result so if cart is empty dont add products
    while($row = $result->fetch_assoc()) {

      $product_id = $row["product_id"];
      $quantity = $row["quantity"];
      $color = $row["color"];

      $stock_quantity = get_quantity_product_inventory($con, $product_id, $color);

      $new_quantity = $stock_quantity - $quantity;

      if($new_quantity >= 0){
        update_product_inventory_quantity($con, $new_quantity, $product_id, $color);
      }else{
        $no_items_in_order = get_amount_of_order_items($con, $order_id);

        if($no_items_in_order == 0){
          delete_from_orders($con, $order_id);
        }
        echo"Sorry item is not in stock";
        mysqli_rollback($con);

        ?>
        <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="/Css/shopping_cart_page.css">
            <title>Offbrand.pwr</title>
          </head>
          <body>
              <h2></h2>
              <h3><a href="/index.php">Click here to return to the front page</a></h3>
          </body>
        </html>
        <?php
        exit;
      }
    }

    insert_into_order_items($con, $order_id, $cart_id);

    delete_from_cart_items($con, $cart_id);

    delete_from_carts($con, $cart_id);

    unset($_SESSION["cart_id"]);//Reset cart_id variable
    unset($_SESSION["order_id"]);//Reset order_id variable

    /* If code reaches this point without errors then commit the data in the database */
    mysqli_commit($con);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($con);
    echo "Something went wrong";
    throw $exception;
}

  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="/Css/shopping_cart_page.css">
      <title>Offbrand.pwr</title>
    </head>
    <body>
        <h2>Item(s) Purchased</h2>
        <h3><a href="/index.php">Click here to return to the front page</a></h3>
    </body>
  </html>
  <?php
}
?>
