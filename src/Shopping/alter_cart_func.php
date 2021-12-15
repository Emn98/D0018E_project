<?php 

  session_start();

  //Connect to database.
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  //If the remove product function have been called. 
  if(isset($_POST["delete"])){
      $product_id = $_POST["product_id"];
      $color = $_POST["color"];
      $cart_id = $_SESSION["cart_id"];

      print_r($_POST);
      
      $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=? AND product_id=? AND color=?");
      $query->bind_param("iis", $cart_id, $product_id, $color);
      $query->execute();
      $query->close();
  }

    //If the add one item button have been pressed
    if(isset($_POST["add"])){
      $product_id = $_POST["product_id"];
      $color = $_POST["color"];
      $new_quantity = (int) $_POST["quantity"];
      $cart_id = $_SESSION["cart_id"];

      print_r($_POST);
      
      $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND cart_id=? AND color=?");
      $query -> bind_param("iiis",$new_quantity, $product_id, $cart_id, $color);
      $query -> execute();
      $query->close();
  }






?>