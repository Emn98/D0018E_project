<?php 

  session_start();

  //Connect to database.
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  //If the remove product function have been called. 
  if(isset($_POST["remove"])){
      $product_id = $_POST["product_id"];
      $color = $_POST["color"];
      $cart_id = $_SESSION["cart_id"];

      print_r($_POST);
      
      $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=? AND product_id=? AND color=?");
      $query->bind_param("i", $cart_id, $product_id, $cart_id);
      $query->execute();
      $query->close();
  }






?>