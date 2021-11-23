<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/main_page.css">
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
          <li><a href="/Category/category.php">GPU</a></li>
          <li><a href="/Category/category.php">CPU</a></li>
        </ul>
        
      </div>
      <div class="item3">
        <?php

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $category_id = 1;

        $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE category_id = ?");

        $stmt->bind_param("i", $category_id);

        $stmt->execute();

        $result = $stmt->get_result();

        echo "<ul>";
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
            echo "<li>";
            echo "<div>";
            echo "<img src ='$picture' width = '200' height = '250'>" . "<br>";
            echo "$name". "<br>";
            echo "$description";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";

        $con->close();

        ?>
      </div>
    </div>
  </body>
</html>