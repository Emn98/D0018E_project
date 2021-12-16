<!-- This php scirpt will check if the logged in user have a order in the database and
if not it will create one for him/her -->
<?php
  //Check so the user is logged in.  
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Accounts/log_in_check.php";
  require($path);

  session_start();

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $user_id = $_SESSION["user_id"];
  $cart_id = $_SESSION["cart_id"];

  $query2 = $con->prepare("SELECT COUNT(*) FROM CART_ITEMS WHERE cart_id=?" );
  $query2->bind_param("i", $cart_id);
  $query2->execute();
  $query2->bind_result($count);
  $query2->fetch();
  $query2->close();

  //Check if the user have a shopping order in the database
  if($count != 0){
    if(gettype($_SESSION["order_id"]) == "NULL" || !isset($_SESSION["order_id"])){
      $query = $con->prepare("INSERT INTO ORDERS (user_id) VALUES(?)");//If not create the order
      $query -> bind_param("i", $user_id);
      $query -> execute();
      $query->close();

      //Kollar den senaste inlagda Order_id som tillagts i Databasen
      $query = $con->prepare("SELECT MAX(order_id) FROM ORDERS WHERE user_id=?");
      $query -> bind_param("i", $user_id);
      $query -> execute();
      $query->bind_result($order_id);
      $query->fetch();
      $query->close();

      $_SESSION["order_id"] = $order_id;
    }
  }else{
    $cart_is_empty = true;
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
      <h2>No items in cart</h2>
      <h3><a href="/index.php">Click here to return to the front page</a></h3>
  </body>
</html>
<?php

  }
?>