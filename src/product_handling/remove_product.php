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

        $stmt = $con->prepare("SELECT product_id FROM PRODUCTS WHERE product_name=?");

        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $stmt->bind_result($product_id);
        $stmt->fetch();

        printf($product_id);
        printf($product_name);
        

        $stmt = $con->prepare("DELETE FROM PRODUCTS WHERE product_id=?");
        
        if ( false===$stmt ) {
          // and since all the following operations need a valid/ready statement object
          // it doesn't make sense to go on
          // you might want to use a more sophisticated mechanism than die()
          // but's it's only an example
          die('prepare() failed: ' . htmlspecialchars($con->error));
        }
        $rc = $stmt->bind_param("i", $product_id);
        if ( false===$rc ) {
          // again execute() is useless if you can't bind the parameters. Bail out somehow.
          die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        
        printf("%d row deleted.\n", $stmt->affected_rows);

        $stmt = $con->prepare("DELETE FROM PRODUCT_INVENTORY WHERE product_id=?");

        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        printf("%d row deleted.\n", $stmt->affected_rows);

        $con->close();
        
      ?>

    <form action="remove_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>