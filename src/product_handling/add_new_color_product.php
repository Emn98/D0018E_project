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
      
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $color = $_POST['color'];

        // establish connection
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);


        //Insert information into the product category
        $query= $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES (?, ?, ?)");
        $query-> bind_param("iis", $product_id, $quantity, $color);
        $query->execute();
        $query->close();

        echo "<div class='form'>";
        echo "<h3>Product Created Succesfully.</h3><br/>";
        echo "<p class='link'>Click here to <a href='/product_handling/add_product_form.php'>continue!</a>.</p>";
        echo "</div>";
        
      ?>

    <form action="add_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>