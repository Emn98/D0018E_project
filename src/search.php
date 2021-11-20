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
            echo "<img src ='$picture' width = '200' height = '250'>" . "<br>";
            echo "<label class='product_name_label'>$name</label>";
            echo "<label class='product_name_label'>$description</label>";
            echo "</div>";
        }
        echo "</div>";

        $con->close();
        
        ?>
      </div>
    <div>
  </body>
</html>