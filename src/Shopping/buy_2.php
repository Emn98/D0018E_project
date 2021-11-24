<?php

  session_start();

  //Check so the user have a cart. 
/*  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Shopping/check_shopping.php";
  require($path)*/;

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path); 
  
  $quantity = $_POST['quantity'];
  $product_id = $_POST['product_id'];
  $user_id = $_SESSION["user_id"];

  echo"$quantity";
  echo "$user_id";
  echo "$product_id";


 //Check the database if product already in cart
 $query = $con->prepare("SELECT quantity FROM CART_ITEMS WHERE user_id=? and product_id=?");
 $query->bind_param("ii", $user_id, $product_id);
 $query->execute();
 $query->bind_result($quantity_in_cart);
 $query->fetch();
 $query->close();
 

 if($quantity_in_cart != ""){
    $quantity = $quantity + $quantity_in_cart;
    echo"Uppdate";
    $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND user_id=?");
    $query -> bind_param("iii", $quantity , $product_id, $user_id);
    $query -> execute();
    $query->close();
 }else{
     echo"ADDD";
    $query = $con->prepare("INSERT INTO CART_ITEMS (user_id, product_id, quantity) 
                            VALUES(?,?,?)"); 
    $query -> bind_param("iii",$user_id, $product_id, $quantity);
    $query -> execute();
    $query->close();
 }

 echo"added item to shopping cart";

?>