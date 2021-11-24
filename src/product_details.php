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
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <div class = "grid-container">
      <div class = "item1">
        <h1>OFF<span>BRAND</span></h1>
        <form class="search_bar_form" method="POST" action="/search.php">
            <input class="search_bar_inp" type="text" name="product_name">
            <button type="submit" class="search_btn">Search</button>
        </form>
        <nav>
          <ul class="menu">
            <li><a href="/Accounts/site_director.php">My page</a></li>
            <li><a href="/test.php">Shopping cart</a></li>
          </ul>
        </nav>
      </div>
      <div class="item2">

        <!-- This is categorie search -->

        <ul class="category_list_ul">
          <li><a href="/Category/gpu.php">GPU</a></li>
          <li><a href="/Category/cpu.php">CPU</a></li>
        </ul>
        
      </div>
      <div class="item3">
        <?php

          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/database.php";
          include_once($path);

          $product_name = $_POST['product_name'];
          $_SESSION['quantity'] = $_POST['quantity'];

          $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name LIKE ?");

          $stmt->bind_param("s", $product_name);


          $stmt->execute();

          $result = $stmt->get_result();

          echo "<div class='product_details_container'>";
          while ($row = $result->fetch_assoc()) {
            $name   = $row['product_name'];
            $description = $row['product_description'];
            $category = $row['category_id'];
            $product_quantity   = $row['quantity'];   //changed to product_quantity instead of quantity
            $price = $row['price'];
            $size = $row['size'];
            $color = $row['color'];
            $discount = $row['discount'];
            $picture = $row['picture'];
            $product_id = $row['product_id'];
            echo "<div class='product_details_image_div'>";
            echo "<img src ='$picture'>";
            echo "</div>";
            echo "<div class='product_details_quantity_div'>";
            echo "<label class='product_details_quantity_label'>$product_quantity</label>"; //changed
            echo "</div>";
            echo "<div class='product_details_price_div'>";
            echo "<label class='product_details_price_label'>$price</label>";
            echo "<form action='/Shopping/buy.php' method='post'>";
            echo "<input type='hidden' name='product_id' value ='<?php echo $product_id; ?>'>";
            echo "<input type='hidden' name='quantity' value ='<?php echo $quantity; ?>'>"; //changed
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
        </form>
      </div>
    <div>

    <form class="buy_button" method="POST" action="/Shopping/buy_2.php"> 
      <div class="form_elements">
        <input type="number" id="quantity" name="quantity" class="register_input" placeholder="Quantity" required>
        <label for="quantity" class="form_label">Enter Quantity</label>
        <input type="hidden" id="product_id" name="product_id" class="register_input" value=<?php echo "$product_id";?>>
        <button class="form_button">Buy</button>
      </div>
  </body>
</html>