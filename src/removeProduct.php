<html>
  <head>
      <title>Remove Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
        
        include("database.php");

        $query = "DELETE FROM  PRODUCTS WHERE product_name LIKE '$product_name'";

        // perform query

        $result = $con->query($query);
        if($result == true){
          echo "item sucessfully deleted to table";
        }

        $con->close();
        
      ?>
  </body>
</html>