<!-- This will serve as the shopping cart page for our e-comerce site offbrand.pwr-->
<?php
  
  session_start();

  //Check so the user is logged in
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Accounts/log_in_check.php";
  require($path);

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  include("update_shopping_cart.php");

  update_shopping_cart_total();

  $cart_id = $_SESSION["cart_id"];

  //Retrive all items associated with the logged in users cart. 
  $query = $con->prepare("SELECT product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
  $query->bind_param("i", $cart_id);
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();

  //Retrive the total price from the user's cart
  $query = $con->prepare("SELECT total_price FROM CARTS WHERE cart_id=?");
  $query->bind_param("i", $_SESSION["cart_id"]);
  $query->execute();
  $query->bind_result($total_price);
  $query->fetch();
  $query->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/shopping_cart_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Include JQuery library -->
    <title>Offbrand.pwr</title>
  </head>
  <body>
  <div class="container">
    <header>
      <h1>OFF<span>BRAND</span></h1>
      <div class="search_bar_container">
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name" placeholder="Search...">
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
     </div>
      <nav>
        <ul class="nav_menu">
          <li><a href="/index.php"><i class="fa fa-sign-out"></i>Home</a></li>
          <li><a href="/Accounts/site_director.php">My Page</a></li>
        </ul>
      </nav>
      </header>
        <div class="shopping_cart">
          <div class="cart_container">
            <h2>Shopping cart</h2>
            <table>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $temp = 1;
               while ($row = $result->fetch_assoc()) {
                $query = $con->prepare("SELECT price, discount, picture, product_name FROM PRODUCTS WHERE product_id=?");
                $query->bind_param("i", $row["product_id"]);
                $query->execute();
                $query->bind_result($product_price, $discount_price, $picture, $product_name);
                $query->fetch();
                $query->close();

                $color = $row["color"];
                $quantity = $row["quantity"];

                $sub_total = 0;
                $sub_total_discount= 0;

                $sub_total = $quantity*$product_price;
                if($discount_price != 0){
                  
                  $sub_total_discount = $quantity*$discount_price;
                }
                
                if($temp == 1){
                  echo "<tr class='table_row_odd'>";
                  echo "<td>";
                  echo "<div class='product_display'>";
                  ?>
                 <img src ='<?php echo $picture ?>' alt="product"/>
                  <?php
                  echo "<div class='product_info'>";
                  echo "<p>$product_name</p>";
                  ?>
                    <input type="button" value="Remove" onclick="remove_item('<?php echo $row['product_id'] ?>', '<?php echo $color ?>')" class="remove_btn">
                  <?php
                  echo"</div>";
                  echo"</div>";
                  echo "</td>";
                  echo "<td>$color</td>";
                  echo "<td>$quantity</td>";
                  if($sub_total_discount!=0){
                    echo "<td><strike>$sub_total$</strike> <br>";
                    echo "<p style='color:red';>$sub_total_discount$</p> </td>";
                  }else{
                    echo "<td>$sub_total$</td>";
                  }
                  echo "</tr>";
                  $temp = 0;
                }else{
                  echo "<tr class='table_row_even'>";
                  echo "<td>";
                  echo "<div class='product_display'>";
                  ?>
                   <img src =<?php echo $picture ?>>
                 <?php
                  echo "<div class='product_info'>";
                  echo "<p>$product_name</p>";
                  ?>
                    <input type="button" value="Remove" onclick="remove_item('<?php echo $row['product_id'] ?>', '<?php echo $color ?>')" class="remove_btn">
                  <?php  
                  echo"</div>";
                  echo"</div>";
                  echo "</td>";
                  echo "<td>$color</td>";
                  echo "<td>";
                  ?>
                  <button class="modi_btn_plus">+</button>
                  <p><?php echo $quantity; ?></p>
                  <button class="modi_btn_minus">-</button>
                  <?php
                  echo "</td>";
                  if($sub_total_discount!=0){
                    echo "<td><strike>$sub_total$</strike> <br>";
                    echo "<p style='color:red';>$sub_total_discount$</p> </td>";
                  }else{
                    echo "<td>$sub_total$</td>";
                  }
                  echo "</tr>";
                  $temp = 1;
                }
               }
              ?>
              </tbody>
            </table>
            <?php 
              if($total_price != 0){//Display delete brn if there is stuff in cart
                echo '<form class="Delete_product_btn_form" action="delete_cart_user.php">';
                echo '<button class="delete_btn">Delete Cart</button>';
                echo '</form>';
              }
            ?>
          </div>
        </div>
        <div class="shopping_cart_info">
          <div class="in_shopping_cart_info">
            <h3>Summary</h3>
            <table class="info_table">
              <tr>
                <td class="total_label">Total:</td>
                <td class="total_price"><?php echo$total_price;?>$</td>
              </tr>
            </table>
            <div class="buy_btn_cont">
            <form class="buy_product_btn_form" action="buy_cart.php">
              <button class="buy_btn">Purchase</button>
            </form>
            </div>
          </div>
        </div>    
      <div class="left_side"></div>
      <div class="right_side"></div>
	</div>
  <script>
    function remove_item(id, color){
      var re = 1;
      $.ajax({
          type: "POST",
          url:  "alter_cart_func.php", 
          data: {product_id: id,
                 color: color,
                 remove: re
                },                
          success: function(response){
            location.reload();
          },
          error: function(){
            alert("failure");
                }
            });
          }
      </script>
  </body>
</html>