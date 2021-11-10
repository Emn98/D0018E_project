<html>
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

       $stmt = $con ->prepare("INSERT INTO PRODUCTS (product_name, product_description, category_id, quantity, price, size, color, discount, picture)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // perform query

        $stmt->bind_param("ssiiiisis", $product_name, $product_description, $category, $quantity, $price, $size, $color, $discount, $picture);

        $stmt->execute();

        printf("%d row inserted.\n", $stmt->affected_rows);

        $con->close();
        
      ?>

    <form action="add_product_form.php" method="post">
    <input type="submit" placeholder="Return">

  </body>
</html>