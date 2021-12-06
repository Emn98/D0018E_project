<?php  

  
  session_start();

  //Create connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $cart_id = $_SESSION["cart_id"];

  //If the user have a cart delete it. 
  if(gettype($_SESSION["cart_id"]) != "NULL" && isset($_SESSION["cart_id"])){
    
    $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
    
    $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
    
    unset($_SESSION["cart_id"]);//Reset cart_id variable

    header("Location: /Shopping/shopping_cart.php");
    exit;
  }else{
    header("Location: /Shopping/shopping_cart.php");
    exit;
  }
?>