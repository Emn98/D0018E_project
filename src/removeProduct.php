<html>
  <head>
      <title>Add Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $productName = $_POST['productName'];
        
        include("database.php");

        $query = "DELETE FROM  Products WHERE productName LIKE '$productName'";

        // perform query

        $result = $conn->query($query);
        if($result == true){
          echo "item sucessfully added to table";
        }

        $conn->close();
        
      ?>
  </body>
</html>