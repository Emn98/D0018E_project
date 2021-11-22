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

        // UPDATE PRODUCTS -> UPDATE PRODUCT_INVENTORY -> done

        $stmt = $con->prepare("UPDATE PRODUCTS SET product_name=?, product_description=?, category_id=?,
        price=?, size=?,discount=?, picture=? WHERE product_name=?");

        $stmt->bind_param("ssiiiiss", $product_name, $product_description, $category, $price, $size, $discount, $picture, $product_name);
        $stmt->execute();

        printf("%d row edited.\n", $stmt->affected_rows);

        $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET quantity=?, color=? WHERE product_id=(SELECT product_id FROM PRODUCTS WHERE product_name=?");

        $stmt->bind_param("iss", $quantity, $color, $product_name);
        $stmt->execute();

        printf("%d row edited.\n", $stmt->affected_rows);

        $con->close();
        
      ?>

    <form action="edit_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>