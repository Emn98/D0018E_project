    <!--This script will check if the user is logged in, if not redirect to log in page -->
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

  //Check if the user have a shopping cart in the database
  if(!isset($_SESSION["cart_id"])){
    $query = $con->prepare("INSERT INTO CARTS (user_id) VALUE(?)");
    $query -> bind_param("i", $user_id);
    $query -> execute();
    $query->close();

    $query = $con->prepare("SELECT cart_id FROM CARTS WHERE user_id=?");
    $query -> bind_param("i", $user_id);
    $query -> execute();
    $query->bind_result($cart_id);
    $query->fetch();
    $query->close();

    $_SESSION["cart_id"] = $cart_id;
  }
?>