<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">

    <title>Remove Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
        
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $stmt = $con->prepare("DELETE FROM PRODUCT_INVENTORY WHERE product_id=(SELECT product_id FROM PRODUCTS WHERE product_name=?))");

        $stmt->bind_param("s", $product_name);
        $stmt->execute();

        printf("%d row deleted.\n", $stmt->affected_rows);

        $stmt = $con->prepare("DELETE FROM PRODUCTS WHERE product_name=?");

        $stmt->bind_param("s", $product_name);
        $stmt->execute();

        printf("%d row deleted.\n", $stmt->affected_rows);

        $con->close();
        
      ?>

    <form action="remove_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>