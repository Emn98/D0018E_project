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

if(!$cart_is_empty){
  $cart_id = $_SESSION["cart_id"];
  $user_id = $_SESSION["user_id"];
  $order_id = $_SESSION["order_id"];

  
  /* Start transaction */
mysqli_begin_transaction($con);

try { 
    update_shopping_cart_total();

    $query2 = $con->prepare("SELECT product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?" );
    $query2->bind_param("i", $cart_id);
    $query2->execute();
    $result = $query2->get_result();
    $query2->fetch();
    $query2->close();

    //Fix result so if cart is empty dont add products
    while($row = $result->fetch_assoc()) {

      $product_id = $row["product_id"];
      $quantity = $row["quantity"];
      $color = $row["color"];

      $query2 = $con->prepare("SELECT quantity FROM PRODUCT_INVENTORY WHERE product_id=? and color=?" );
      $query2->bind_param("is", $product_id, $color);
      $query2->execute();
      $query2->bind_result($stock_quantity);
      $query2->fetch();
      $query2->close();

      $new_quantity = $stock_quantity - $quantity;

      if($new_quantity >= 0){
        $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET quantity=? WHERE product_id=? AND color=?");
        $stmt->bind_param("iis", $new_quantity, $product_id, $color);
        $stmt->execute();
        $stmt->close();
      }else{
        $query = $con->prepare("SELECT COUNT(*) FROM ORDER_ITEMS WHERE order_id=?" );
        $query->bind_param("i", $order_id);
        $query->execute();
        $query->bind_result($no_items_in_order);
        $query->fetch();
        $query->close();

        if($no_items_in_order == 0){
          $query = $con->prepare("DELETE FROM ORDERS WHERE order_id=?");
          $query->bind_param("i", $order_id);
          $query->execute();
          $query->close();
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

    $query = $con->prepare("INSERT INTO ORDER_ITEMS (order_id, product_id, quantity, color) SELECT ?, product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("ii", $order_id, $cart_id);
    $query->execute();
    $query->close();


    $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();

    $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();

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
