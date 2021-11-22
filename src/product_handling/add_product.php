<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">

    <title>Add Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];

        // establish connection
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        // INSERT PRODUCTS -> INSERT PRODUCT_INVENTORY -> UPDATE inventory_id in PRODUCTS -> done

        $stmt = $con->prepare("INSERT INTO PRODUCTS (product_name, product_description, category_id, inventory_id, price, size, discount, picture)
          VALUES (?, ?, ?, NULL, ?, ?, ?, ?)");

        $stmt->bind_param("ssiiiis", $product_name, $product_description, $category, $price, $size, $discount, $picture);

        $stmt->execute();

        $stmt = $con->prepare("INSERT INTO PRODUCT_INVENTORY (product_id, quantity, color) VALUES ((SELECT product_id FROM PRODUCTS WHERE product_name=?),
        ?,?)");

        $stmt->bind_param("sis", $product_name, $quantity, $color);
        $stmt->execute();

        $stmt = $con->prepare("UPDATE PRODUCTS SET inventory_id=(SELECT MAX(inventory_id) FROM PRODUCT_INVENTORY) WHERE product_name=?");

        $stmt->bind_param("s", $product_name);

        $stmt->execute();

        // perform query

        

        printf("%d row inserted.\n", $stmt->affected_rows);

        $con->close();
        
      ?>

    <form action="add_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>