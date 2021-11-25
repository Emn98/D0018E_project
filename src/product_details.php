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

          $query = $con->prepare("SELECT quantity, color FROM PRODUCT_INVENTORY WHERE product_id=?");
          $query->bind_param("i", $product_id);
          $query->execute();
          $query->bind_result($product_quantity, $color);
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
            echo "<div class='product_details_image_div'>";
            echo "<img src ='$picture'>";
            echo "</div>";
            echo "<div class='product_details_quantity_div'>";
            echo "<label class='product_details_quantity_label'>Current quantity: $product_quantity</label>";
            echo "<label class='product_details_quantity_label'>Available color: $color</label>";
            echo "</div>";
            echo "<div class='product_details_price_div'>";
            echo "<label class='product_details_price_label'>Current Price: $price</label>";
            echo "<form class='buy_button' method='POST' action='/Shopping/buy.php'>";
            echo "<div class='form_elements'>";
            echo "<input type='number' id='quantity' name='quantity' class='register_input' placeholder='Quantity' min='0' max='<?php echo $product_quantity ?>' required>";
            echo "<label for='quantity' class='form_label'>Enter Quantity</label>";
            echo "<form action='/Shopping/buy_2.php' method='post'>";
            echo "<input type='hidden' id='product_id' name='product_id' class='register_input' value='<?php echo $product_id;?>'>";
            echo "<button class='form_button'>Buy</button>";
            echo "</div>";
            echo "<input type='hidden' name='product_id' value ='<?php echo $product_id; ?>'>";
            echo "<input type='hidden' name='quantity' value ='<?php echo $product_quantity; ?>'>";
            echo "</form>";
            echo "</div>";
            echo "<div class='best_customer_review_div'>";
            echo "this is future best customer review";
            echo "</div>";
            echo "<div class='customer_reviews_div'>";
            echo "this is future customer reveiw";
            echo "</div>";
            echo "<div class='product_details_details_div'";
            echo "<label class='product_name_label'>$name</label>";
            echo "<label class='product_name_label'>$description</label>";
            echo "</div>";
          }
          echo "</div>";
          $con->close();           
          ?>
        </div>
      </main>
    </div>
    <div>
  </body>
</html>