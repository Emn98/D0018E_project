<?php
require("check_admin.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>

    <title>Edit Product</title>  
  </head>
  <body>
      
      <?php

        print_r($_POST);
        
        
        
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];
        $color_arr = $_POST['color'];
        $quantity_arr = $_POST['quantity'];
        $old_color_arr = $_POST['old_color'];

        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include($path);

        // UPDATE PRODUCTS -> UPDATE PRODUCT_INVENTORY -> done

        $stmt = $con->prepare("UPDATE PRODUCTS SET product_description=?, category_id=(SELECT category_id FROM CATEGORIES WHERE category_name=?), price=?, size=?, discount=?,
        picture=? WHERE product_name=?");
        $stmt->bind_param("ssiiiss", $product_description, $category, $price, $size, $discount, $picture, $product_name);
        $stmt->execute();
        $stmt->close();
        
        /*//XD WILL THIS WORK
        $sql = "UPDATE PRODUCT_INVENTORY SET color = (CASE ";
        for($i = 0; $i < sizeof($color_arr); $i++){
          $old_color = $old_color_arr[$i];
          $new_color = $color_arr[$i];
          $sql .= " WHEN color = $old_color THEN color = $new_color";
        }
        $sql .= " SET quantity = (CASE ";
        for($i = 0; $i < sizeof($quantity_arr); $i++){
          $old_color = $old_color_arr[$i];
          $new_quantity = $color_arr[$i];
          $sql .= " WHEN color = $old_color THEN quantity = $new_quantity";
        }
        $sql .= " END) WHERE product_id = (SELECT product_id FROM PRODUCTS WHERE product_name = ?)";
        
        echo "<br>";
        echo $sql;

        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $stmt->close();
      */
      ?>
      

    <form action="edit_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>