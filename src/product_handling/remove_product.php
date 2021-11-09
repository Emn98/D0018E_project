<html>
  <head>
      <title>Remove Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
        
        include("/database.php");

        $stmt = $con->prepare("DELETE * FROM  PRODUCTS WHERE product_name LIKE ?");

        // perform query

        $stmt->bind_param("s", $product_name);

        $stmt->execute();

        printf("%d row deleted.\n", $stmt->affected_rows);

        $con->close();
        
      ?>
  </body>
</html>