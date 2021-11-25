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

            if($product_name == ""){
              $stmt = $con->prepare("SELECT * FROM PRODUCTS");
            } else{

              $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name LIKE ?");

              $stmt->bind_param("s", $product_name);
            }

            $stmt->execute();

            $result = $stmt->get_result();

            echo "<div class='wrapper'>";
            while ($row = $result->fetch_assoc()) {
                $name   = $row['product_name'];
                $description = $row['product_description'];
                $category = $row['category_id'];
                $quantity   = $row['quantity'];
                $price = $row['price'];
                $size = $row['size'];
                $color = $row['color'];
                $discount = $row['discount'];
                $picture = $row['picture'];
                echo "<div class='list_product_div'>";
                echo "<img src ='$picture' width = '200' height = '250'>";
                echo "<label class='product_name_label'>$name</label>";
                echo "<label class='product_name_label'>$description</label>";
                echo "<div class='product_price_buy_div'>";
                echo "<label class='product_price_label'>From $price kr</label>";
                echo "<form action='/product_details.php' method='post'>";
                echo "<input type='hidden' name='product_name' value = $name>";
                echo "<button type='submit' class='product_details_button'>Go to product</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";

            $con->close();
            
            ?>
          </div>
        </main>
        <div class="left_side">Left Side</div>
        <div class="right_side">Right Side</div>
    </div>
  </body>
</html>