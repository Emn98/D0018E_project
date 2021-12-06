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

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include_once($path);

            $category_id = (int)$_POST['category_id'];

            $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE category_id = ?");

            $stmt->bind_param("i", $category_id);

            $stmt->execute();

            $result = $stmt->get_result();

            if (mysqli_num_rows($result)==0) {
              echo ("No products matching this category");
            } else {

              echo "<div class='wrapper'>";
              while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $name   = $row['product_name'];
                $description = $row['product_description'];
                $category = $row['category_id'];
                $quantity   = $row['quantity'];
                $price = $row['price'];
                $size = $row['size'];
                $color = $row['color'];
                $discount = $row['discount'];
                $picture = $row['picture'];
                ?>
                <div class='list_product_div'>
                  <img src ='<?php echo $picture ?>' width = '200' height = '250'>
                  <label class='product_name_label'><?php echo $name ?></label>
                  <label class='product_name_label'><?php echo $description ?></label>
                  <div class='product_price_buy_div'>
                    <label class='product_price_label'>From <?php echo $price ?> kr</label>
                    <form action='/Product_page/product_details.php' method='post'>
                      <input type='hidden' name='product_id' value ='<?php echo $product_id ?>'>
                      <button type='submit' class='product_details_button'>Go to product</button>
                    </form>
                  </div>
                </div>
                <?php
              }
              echo "</div>";
            }
            $con->close();

            ?>
          </div>
        </main>
        <div class="left_side">Left Side</div>
        <div class="right_side">Right Side</div>
    </div>
  </body>
</html>