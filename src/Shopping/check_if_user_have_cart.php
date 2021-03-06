<!-- This php scirpt will check if the logged in user have a cart in the database and
if not it will create one for him/her -->
<?php
  session_start();

  //Check so the user is logged in.  
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Accounts/log_in_check.php";
  include($path);

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $user_id = (int) $_SESSION["user_id"];

  //Check if the user have a shopping cart in the database
  if(gettype($_SESSION["cart_id"]) == NULL || !isset($_SESSION["cart_id"]) && $user_id != 0){
    $query= $con->prepare("INSERT INTO CARTS (user_id) VALUES (?)");
    $query-> bind_param("i", $user_id);
    $query->execute();
    $query->close();

    $query = $con->prepare("SELECT cart_id FROM CARTS WHERE user_id = ?");
    $query->bind_param("s", $user_id);
    $query->execute();
    $query->bind_result($cart_id);
    $query->fetch();
    $query->close();

    $_SESSION["cart_id"] = $cart_id;
  }
?>