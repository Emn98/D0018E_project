
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/reg_page_2.css">
    <title>Add Category - Offbrand.pwr</title>
  </head>
  <body>
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

          if($quantity > 99){
            $quantity = 99;
            $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND cart_id=? AND color=?");
            $query -> bind_param("iiis",$quantity, $product_id, $cart_id, $product_color);
            $query -> execute();
            $query->close();
          }else{
            $query = $con->prepare("UPDATE CART_ITEMS SET quantity=? WHERE product_id=? AND cart_id=? AND color=?");
            $query -> bind_param("iiis", $quantity , $product_id, $cart_id, $product_color);
            $query -> execute();
            $query->close();
        }
        }else{//If the item don't already exist in user's cart. 
          if($quantity > 99){
            $quantity = 99;
            $query = $con->prepare("INSERT INTO CART_ITEMS (cart_id, product_id, quantity, color) 
            VALUES(?,?,?,?)"); 
            $query -> bind_param("iiis",$cart_id, $product_id, $quantity, $product_color);
            $query -> execute();
            $query->close();
          }else{
            $query = $con->prepare("INSERT INTO CART_ITEMS (cart_id, product_id, quantity, color) 
            VALUES(?,?,?,?)"); 
            $query -> bind_param("iiis",$cart_id, $product_id, $quantity, $product_color);
            $query -> execute();
            $query->close();
          }
        }
       
        echo "<div class='form'>";
        echo "<h3>Product has been added to cart.</h3><br/>";
        echo "<p class='link'>Click here to <a href='/Shopping/shopping_cart.php'>go to Cart</a>.</p>";
        echo "<br>";
        echo "<p class='link'>Click here to <a href='/index.php'>continue shopping</a>.</p>";
        echo "</div>";
      }
    ?>
  </body>
</html>