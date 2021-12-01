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

    <title>Add Product</title>  
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

        $new_arr = array_merge($color_arr, $quantity_arr);
        echo "<br>";
        print_r($new_arr);
        echo "<br>";
        print_r($new_arr[0]);
        echo "<br>";
        print_r($new_arr[1]);


        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        /*

        // UPDATE PRODUCTS -> UPDATE PRODUCT_INVENTORY -> done

        $stmt = $con->prepare("UPDATE PRODUCTS SET product_description=?, category_id=(SELECT category_id FROM CATEGORIES WHERE category_name=?), price=?, size=?, discount=?,
        picture=?");

        $stmt->bind_param();
        $stmt->execute();
        $stmt->close();

        
        
        $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET color=")
      */
      ?>
      

    <form action="edit_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>