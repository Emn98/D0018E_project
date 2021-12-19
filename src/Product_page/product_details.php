<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/main_page.css">
    <link rel="stylesheet" href="/Css/present_products.css">
    <link rel="stylesheet" href="/Css/category.css">
    <link rel="stylesheet" href="/Css/review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jstmt/3.5.1/jstmt.min.js" type="text/javascript"></script>
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <header class="top_nav_bar">
        <h1 onclick="go_to_start()" style='cursor: pointer;'>OFFBRAND</h1>
        <div class="search_bar_container">
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name" placeholder="Search...">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
     </div>
        <nav>
          <ul class="nav_menu">
            <li><a href="/Accounts/site_director.php">My Page</a></li>
            <?php 
            if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] != 0){//Don't display shopping cart to admin
              echo '<li><a href="/Shopping/shopping_cart.php">Shopping cart</a></li>';
            }
            ?>
          </ul>
        </nav>
      </header>
      <main>
        <div class="inner_left_side">
          <?php 
          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/Category/categories_file2.php";
          include($path);
          ?>
        </div>
        <div class="inner_right_side">
          <?php

          // SELECT PRODUCTS->SELECT PRODUCT_INVENTORY->SELECT PRODUCTS

          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/database.php";
          include_once($path);

          $user_id = $_SESSION['user_id'];

          $product_id = $_POST['product_id'];

          $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_id=?");
          $stmt->bind_param("i", $product_id);
          $stmt->execute();
          $result = $stmt->get_result();

          $stmt = $con->prepare("SELECT * FROM PRODUCT_INVENTORY WHERE product_id=?");
          $stmt->bind_param("i", $product_id);
          $stmt->execute();
          $result_inventory = $stmt->get_result();
          $stmt->fetch();
          $stmt->close();
  
          echo "<div class='product_details_container'>";
          $row = $result->fetch_assoc();
          $name   = $row['product_name'];
          $description = $row['product_description'];
          $category = $row['category_id'];
          $price = $row['price'];
          $discount = $row['discount'];
          $picture = $row['picture'];
          $product_id = $row['product_id'];
          ?>
          <div class='product_details_image_div'>
            <img src ='<?php echo $picture?>' width="200" height="250">
          </div>
          <div class='product_details_quantity_div'>
            <?php
            $color_arr = array();

            echo "<table>".
                  "<thead><tr><td>Available Colors</td><td>Available Quantity</td></tr></thead><tbody>"; 
            while($row_inventory = $result_inventory->fetch_assoc()){
              echo "<tr><td>" . $row_inventory['color'] . "</td><td>" . $row_inventory['quantity'] . "</td></tr>";
              array_push($color_arr,$row_inventory['color']);
            }
            echo "</tbody></table>";
            ?>
          </div>
          <div class='product_details_price_div'>
            <div class="input_details">      
              <form class='buy_button' method='POST' action='/Shopping/add_to_cart.php'>
                <div class='form_elements'>
                  <label for='quantity' class='form_label'>Enter Quantity</label><br>
                  <input type='number' id='quantity' name='quantity' class='purschase_input' placeholder='Quantity' min='0' max='99' required><br>
                  <label for='color_category' class='form_label'>Pick Color</label><br>
                  <select name="product_color" id="color_category">
                  <?php
                  foreach ($color_arr as $value) {
                    echo "<option value='$value'>$value</option>";
                  }
                  ?>
                  </select>
                </div>
                <div class="price_div">
                  <?php 
                    if($discount==0){
                      echo "<h2 class='product_details_price_label'>$price$</h2>";
                    }else{
                      echo "<h2 class='product_details_price_label'><strike> $price$</strike></h2>"; 
                      echo "<h2 class='product_details_price_label' style='color:red';>$discount$ </h2>";
                    }
                  ?>
                  </div>
                  <?php 
                    if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] != 0){//Don't display buy button to admin
                      echo "<button class='form_button'>Add to Shopping cart</button>";
                    }
                  ?>
                
                <input type='hidden' name='product_id' value ='<?php echo $product_id ?>'>
                <input type='hidden' name='product_quantity' value ='<?php echo $product_quantity ?>'>
              </form>
            </div>
          </div>
          <div class='best_customer_review_div'>
            <h3>Voted Best Review</h3>
            <?php
            $product_id = $_POST['product_id'];
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/Product_page/best_review.php";
            include($path);
            ?>
          </div>
          <div class='customer_reviews_div'>
            <h3>Customer Reviews</h3>
            <?php
            $product_id = $_POST['product_id'];
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/Product_page/review.php";
            include($path);
            ?>
          </div>
          <div class='product_details_details_div'>
            <label class='product_name_label'><?php echo $name ?></label>
            <label class='product_name_label'><?php echo $description ?></label>
          </div>         
        </div>
      </main>
    </div>
    <script>
      function go_to_start(){
      window.location.href = "/index.php";
      exit;
      }
    </script>
  </body>
</html>