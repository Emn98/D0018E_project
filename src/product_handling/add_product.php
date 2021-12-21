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
        $default_average_score = 5;
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];

        // establish connection
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        //Check to see if the category already exists
        $query = $con->prepare("SELECT product_name FROM PRODUCTS WHERE product_name = ?");
        $query->bind_param("s", $product_name);
        $query->execute();
        $query->bind_result($product_name_exists);
        $query->fetch();
        $query->close();

        //If the product dosen't already exist. Create new product
        if($product_name_exists==""){
          //Retrive the id of the category this product will be associated with. 
          $query = $con->prepare("SELECT category_id FROM CATEGORIES WHERE category_name = ?");
          $query->bind_param("s", $category);
          $query->execute();
          $query->bind_result($category_id);
          $query->fetch();
          $query->close();

          //Insert the new product into the database
          $query= $con->prepare("INSERT INTO PRODUCTS (product_name, product_description, category_id, price, discount, picture) VALUES (?, ?, ?, ?, ?, ?,5.0)");
          $query-> bind_param("ssiiisi", $product_name, $product_description, $category_id, $price, $discount, $picture, $default_average_score);
          $query->execute();
          $query->close();

          //Retrive the id of the newly created product
          $query = $con->prepare("SELECT product_id FROM PRODUCTS WHERE product_name = ?");
          $query->bind_param("s", $product_name);
          $query->execute();
          $query->bind_result($product_id);
          $query->fetch();
          $query->close();

          //Insert information into the product category
          $query= $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES (?, ?, ?)");
          $query-> bind_param("iis", $product_id, $quantity, $color);
          $query->execute();
          $query->close();

          echo "<div class='form'>";
          echo "<h3>Product Created Succesfully.</h3><br/>";
          echo "<p class='link'>Click here to <a href='/product_handling/add_product_form.php'>continue!</a>.</p>";
          echo "</div>";
        }else{//The product already exists. 

          echo "test1";
          //Retrive the id of the product
          $query = $con->prepare("SELECT product_id FROM PRODUCTS WHERE product_name = ?");
          $query->bind_param("s", $product_name);
          $query->execute();
          $query->bind_result($product_id);
          $query->fetch();
          $query->close();

          //Check if the color already exists
          $query = $con->prepare("SELECT color FROM PRODUCT_INVENTORY WHERE color = ?");
          $query->bind_param("s", $color);
          $query->execute();
          $query->bind_result($product_color_exists);
          $query->fetch();
          $query->close();

          if($product_color_exists==""){
            echo "test2";
            $query= $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES (?, ?, ?)");
            $query-> bind_param("iis", $product_id, $quantity, $color);
            $query->execute();
            $query->close();

            echo "<div class='form'>";
            echo "<h3>New Color Added to product.</h3><br/>";
            echo "<p class='link'>Click here to <a href='/product_handling/add_product_form.php'>continue!</a>.</p>";
            echo "</div>";
          }else{
            echo "<div class='form'>";
            echo "<h3>Error! No product have been added since both this product+color combination already exists.</h3><br/>";
            echo "<p class='link'>Click here to <a href='/product_handling/add_product_form.php'>continue!</a>.</p>";
            echo "</div>";
          }
        }

       /* 
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
       */
      ?>

    <form action="add_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>