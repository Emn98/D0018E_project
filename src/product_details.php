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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <header>
        <h1><a href="/index.php"> OFF<span>BRAND</span> </a></h1>
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name">
          <button type="submit" class="search_btn">Search</button>
        </form> 
        <nav>
          <ul class="nav_menu">
            <li><a href="/Accounts/site_director.php">My Page</a></li>
            <li><a href="/Shopping/shopping_cart.php">Shopping cart</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div class="inner_left_side">
          <?php 
          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/Category/categories_file.html";
          include($path);
          ?>
        </div>
        <div class="inner_right_side">
          <?php

          // SELECT PRODUCTS->SELECT PRODUCT_INVENTORY->SELECT PRODUCTS

          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/database.php";
          include_once($path);

          $product_name = $_POST['product_name'];
          $_SESSION['quantity'] = $_POST['quantity'];

          $query = $con->prepare("SELECT product_id FROM PRODUCTS WHERE product_name=?");
          $query->bind_param("s", $product_name);
          $query->execute();
          $query->bind_result($product_id);
          $query->fetch();
          $query->close();

          $query = $con->prepare("SELECT * FROM PRODUCT_INVENTORY WHERE product_id=?");
          $query->bind_param("i", $product_id);
          $query->execute();
          $result_inventory = $query->get_result();
          $result_inventory_2 = $query->get_result();
          $query->fetch();
          $query->close();

          $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name=?");
          $stmt->bind_param("s", $product_name);
          $stmt->execute();
          $result = $stmt->get_result();
          

          echo "<div class='product_details_container'>";
          while ($row = $result->fetch_assoc()) {
            $name   = $row['product_name'];
            $description = $row['product_description'];
            $category = $row['category_id'];
            $price = $row['price'];
            $size = $row['size'];
            $discount = $row['discount'];
            $picture = $row['picture'];
            $product_id = $row['product_id'];
            ?>
            <div class='product_details_image_div'>
              <img src ='<?php echo $picture ?>'>
            </div>
            <div class='product_details_quantity_div'>
              <?php
              echo "<table>".
                    "<tr><td>Available Colors</td><td>Available Quantity</td></tr>"; 
              while($row_inventory = $result_inventory->fetch_assoc()){
                echo "<tr><td>" . $row_inventory['color'] . "</td><td>" . $row_inventory['quantity'] . "</td></tr>";
              }
              echo "</table>";
              ?>
            </div>
            <div class='product_details_price_div'>
              <label class='product_details_price_label'>Current Price: <?php echo $price ?> </label>
              <form class='buy_button' method='POST' action='/Shopping/add_to_cart.php'>
                <div class='form_elements'>
                  <input type='number' id='quantity' name='quantity' class='purschase_input' placeholder='Quantity' min='0' max='<?php echo $product_quantity ?>' required>
                  <select name="color_category" id="color_category">
                  <?php
                   while($row_inventory_2 = $result_inventory_2->fetch_assoc()){
                    $picked_color = $row_inventory_2['color'];
                    echo "<option value='$picked_color'>$picked_color</option>";
                  }
                  ?>
                  </select>
                  <label for='quantity' class='form_label'>Enter Quantity</label>
                  <input type="hidden" class ="purschase_input" name="product_color"  value="<?php echo '$picked_color';?>">
                    <input type='hidden' id='product_id' name='product_id' class='register_input' value='<?php echo $product_id ?>'>
                    <button class='form_button'>Buy</button>
                </div>
                <input type='hidden' name='product_id' value ='<?php echo $product_id ?>'>
                <input type='hidden' name='product_quantity' value ='<?php echo $product_quantity ?>'>
              </form>
            </div>
            <div class='best_customer_review_div'>
              this is future best customer review
            </div>
            <div class='customer_reviews_div'>
              this is future customer reveiw
            </div>
            <div class='product_details_details_div'>
              <label class='product_name_label'><?php echo $name ?></label>
              <label class='product_name_label'><?php echo $description ?></label>
            </div>
          <?php
          }
          echo "</div>";
          $con->close();           
          ?>
        </div>
      </main>
    </div>
  </body>
</html>