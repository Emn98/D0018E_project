<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

//Check so the user have a cart. 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Shopping/check_if_user_have_order.php";
require($path);

$cart_id = $_SESSION["cart_id"];
$user_id = $_SESSION["user_id"];
$order_id = $_SESSION["order_id"];
echo $cart_id;
echo $user_id;
echo $order_id;

//$stmt = $con->prepare("INSERT INTO ORDER_ITEMS (order_id) VALUES (SELECT order_id FROM ORDERS WHERE user_id=?");                                                                                           
//$stmt->bind_param("i", $user_id);
//$stmt->execute();
//$stmt->close();

//$query = $con->prepare("INSERT INTO ORDER_ITEMS (order_id) VALUES (?)"); 
//$query->bind_param("i", $order_id);
//$query->execute();
//$query->close();
//echo "Test query 1";
//echo $order_id;

//$query = $con->prepare("INSERT INTO ORDER_ITEMS (product_id, quantity, color) WHERE order_id=? VALUES (SELECT product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?)"); 
//$query->bind_param("ii", $order_id, $cart_id);
//$query->execute();
//$query->close();
//echo "Test query 2";

$query = $con->prepare("INSERT INTO ORDER_ITEMS (order_id, product_id, quantity, color) SELECT ?, product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
$query->bind_param("ii", $order_id, $cart_id);
$query->execute();
$query->close();
echo "Test query 1";

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
      <h3><a href="shopping_cart.php">Click here to continue</a></h3>
  </body>
</html>
