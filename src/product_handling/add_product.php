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
      
      <?php

        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];

        // establish connection
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $stmt = $con->prepare("SELECT product_name FROM PRODUCTS WHERE product_name = ? LIMIT 1");
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $stmt->bind_result($product_name_exists);
        $stmt->fetch();

        if($product_name_exists == ""){
          $stmt->close();
        $stmt = $con->prepare("INSERT INTO PRODUCTS (product_name, product_description, category_id, price, discount, picture)
          VALUES (?, ?, (SELECT category_id FROM CATEGORIES WHERE category_name=?), ?, ?, ?)");

        $stmt->bind_param("sssiiis", $product_name, $product_description, $category, $price, $discount, $picture);
        $stmt->execute();
        $stmt->close();

        $stmt = $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES ((SELECT product_id FROM PRODUCTS WHERE product_name=?),
        ?,?)");
        $stmt->bind_param("sis", $product_name, $quantity, $color);
        $stmt->execute();
        $stmt->close();

        } else{
          $stmt->close();
        $stmt = $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES ((SELECT product_id FROM PRODUCTS WHERE product_name=?),
        ?,?)");
        $stmt->bind_param("sis", $product_name, $quantity, $color);
        $stmt->execute();
        $stmt->close();

        }

      ?>

    <form action="add_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>