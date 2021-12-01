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

        $data = $_POST['data'];
        $data = json_decode($data);
        
        /*
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];
        $inventory_id = $_POST['inventory_id'];

        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        

        // UPDATE PRODUCTS -> UPDATE PRODUCT_INVENTORY -> done

        

        $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET quantity=?, color=? WHERE inventory_id = $inventory_id");
          
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        $stmt = $con->prepare("UPDATE PRODUCT SELECT product_id,product_name, inventory_id, color FROM PRODUCTS AS P INNER JOIN PRODUCT_INVENTORY AS P_I ON P.product_id = P_I.product_id");
          
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

      */  
      ?>
      

    <form action="edit_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>