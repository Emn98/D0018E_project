<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$cart_id = $_SESSION["cart_id"];

$query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
$query->bind_param("i", $cart_id);
$query->execute();
$query->close();

$query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
$query->bind_param("i", $cart_id);
$query->execute();
$query->close();

unset($_SESSION["cart_id"]);//Reset cart_id variable
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
