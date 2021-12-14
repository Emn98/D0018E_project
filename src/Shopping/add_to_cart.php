<?php
  session_start();

  //Check so the user have a cart. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Shopping/check_if_user_have_cart.php";
  include($path);

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path); 

  //If a user have come from a product_site. 
  if(isset($_POST["product_id"])){
    $quantity = (int) $_POST['quantity'];
    $product_id = $_POST['product_id'];
    $product_color = $_POST['product_color'];
    $cart_id = $_SESSION["cart_id"];

    //Check the database if product already in cart
    $query = $con->prepare("SELECT quantity FROM CART_ITEMS WHERE cart_id=? AND product_id=? AND color=?");
    $query->bind_param("iis", $cart_id, $product_id, $product_color);
    $query->execute();
    $query->bind_result($quantity_in_cart);
    $query->fetch();
    $query->close();

    //If the ptroduct is already in user's cart. 
    if($quantity_in_cart != ""){
      $quantity = $quantity + $quantity_in_cart;

      $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND cart_id=? AND color=?");
      $query -> bind_param("iiis", $quantity , $product_id, $cart_id, $product_color);
      $query -> execute();
      $query->close();
    }
    }else{//If the item don't already exist in user's cart. 
        $query = $con->prepare("INSERT INTO CART_ITEMS (cart_id, product_id, quantity, color) 
        VALUES(?,?,?,?)"); 
        $query -> bind_param("iiis",$cart_id, $product_id, $quantity, $product_color);
        $query -> execute();
        $query->close();
    }

    //Retrive the price of the product
    $query = $con->prepare("SELECT price FROM PRODUCTS WHERE product_id=?");
    $query->bind_param("i", $product_id);
    $query->execute();
    $query->bind_result($product_price);
    $query->fetch();
    $query->close();

    $query = $con->prepare("SELECT total_price, total_quantity FROM CARTS WHERE cart_id=?");
    $query -> bind_param("i",  $cart_id);
    $query -> execute();
    $query->bind_result($total_price, $total_quantity);
    $query->fetch();
    $query->close();
   
    $new_total_quantity = $total_quantity + $quantity;
    $new_total_price = $total_price + ($product_price * $quantity);

    echo $total_price;
    echo $total_quantity;
    echo $quantity;
    echo $product_price;
    echo gettype($total_quantity);
    echo gettype($total_price);
    echo $new_total_quantity;
    echo $new_total_price;
  
    $query = $con->prepare("UPDATE CARTS SET total_quantity=?, total_price=? WHERE cart_id=?");
    $query -> bind_param("iii", $new_total_quantity, $new_total_price, $cart_id);
    $query -> execute();
    $query->close();

    echo "<div class='form'>
    <h3>Products Has Been Added To Cart.</h3><br/>
    <p class='link'>Click here to <a href='/Shopping/shopping_cart.php'>go to Cart</a>.</p>
    <p class='link'>Click here to <a href='/index.php'>continue shopping</a>.</p>
    </div>";
  }
?>