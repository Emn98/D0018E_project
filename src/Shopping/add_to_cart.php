<?php

  session_start();

  //Check so the user have a cart. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Shopping/check_if_user_have_cart.php";
  require($path);

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path); 
  
  $quantity = $_POST['quantity'];
  $product_id = $_POST['product_id'];
  $product_color = $_POST['product_color'];
  $cart_id = $_SESSION["cart_id"];

  echo $product_color;

  //Check the database if product already in cart
  $query = $con->prepare("SELECT quantity FROM CART_ITEMS WHERE cart_id=? and product_id=? and color=?");
  $query->bind_param("ii", $cart_id, $product_id);
  $query->execute();
  $query->bind_result($quantity_in_cart);
  $query->fetch();
  $query->close();
 

  if($quantity_in_cart != ""){
    $quantity = $quantity + $quantity_in_cart;
    $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND cart_id=?");
    $query -> bind_param("iii", $quantity , $product_id, $cart_id);
    $query -> execute();
    $query->close();
 }else{
    $query = $con->prepare("INSERT INTO CART_ITEMS (cart_id, product_id, quantity) 
                            VALUES(?,?,?)"); 
    $query -> bind_param("iii",$cart_id, $product_id, $quantity);
    $query -> execute();
    $query->close();
 }

 echo "<div class='form'>
             <h3>Products Has Been Added To Cart.</h3><br/>
             <p class='link'>Click here to <a href='/Shopping/shopping_cart.php'>go to Cart</a>.</p>
             <p class='link'>Click here to <a href='/index.php'>continue shopping</a>.</p>
             </div>";
?>








