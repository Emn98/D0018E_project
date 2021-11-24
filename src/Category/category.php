<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/main_page.css">
    <link rel="stylesheet" href="/Css/present_product.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
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
      </div>
      <div class="item3">
        <?php

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $category_id = (int)$_POST['category_id'];
        echo ($category_id);
        

        $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE category_id = ?");

        $stmt->bind_param("i", $category_id);

        $stmt->execute();

        $result = $stmt->get_result();

        if (mysqli_num_rows($result)==0) {
          echo ("No products matching this category");
        } else {

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
            echo "<form action='/product_details.php' method='post'>";
            echo "<input type='hidden' name='product_name' value = $name>";
            echo "<button type='submit' class='product_details_button'>Go to product</button>";
            echo "</form>";
            echo "</div>";
        }
        echo "</div>";
      }
        $con->close();

        ?>
      </div>
    </div>
  </body>
</html>