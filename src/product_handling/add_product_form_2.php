<?php
require("check_admin.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Add Product</title>
  </head>
  <body>
    <div class="product_div">
      <div class="inner_product_div">
        <h1>Add Product Page</h1>

        <form action="/product_handling/add_product.php" method="post">
        <label for="product_name">Name</label>
        <input type="text" id="name" name="product_name" placeholder="product name" required><br>
        <label for="product_description">Description</label>
        <input type="text" id="description" name="product_description" placeholder="product description" required><br>    
        <label for="category">Category</label>
        <select name="category" id="category">
        <?php

          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/database.php";
          include_once($path);

          $stmt = $con->prepare("SELECT * FROM CATEGORIES");
          
          $stmt->execute();

          $result = $stmt->get_result();
 
          while($row = $result->fetch_assoc()){
            $category_name = $row['category_name'];
            echo "<option value='$category_name'>$category_name</option>";
          }
          
         ?>
         </select>
        <label for="quantity">Quantity</label>
        <input type="text" id="quantity" name="quantity" placeholder="quantity" required><br>
        <label for="color">Color</label>
        <input type="text" id="color" name="color" placeholder="color" required><br>
        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="price" required><br>
        <label for="discount">Discount</label>
        <input type="text" id="discount" name="discount" placeholder="discount" required><br>
        <label for="picture">Picture</label>
        <input type="text" id="picture" name="picture" placeholder="picture url" required><br>
        <button type="submit" class="btn">Send</button>
        </form>

        <form action="/Accounts/admin_page.php" method="post">
          <button type="submit" class="btn">Return</button>
        </form>
      </div>
    </div>
  </body>
</html>
<?php

?>