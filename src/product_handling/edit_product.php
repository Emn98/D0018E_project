<html>
  <head>
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

        $stmt = $con->prepare("UPDATE PRODUCTS SET product_name=?, product_description=?, category_id=?,
         quantity=?, price=?, size=?, color=?, discount=?, picture=? WHERE product_name LIKE ?");

        // perform query

        $stmt->bind_param("ssiiiisiss", $product_name, $product_description, $category, $quantity, $price, $size, $color, $discount, $picture, $product_name);

        $stmt->execute();

        printf("%d row edited.\n", $stmt->affected_rows);

        $con->close();
        
      ?>
  </body>
</html>