<html>
  <head>
      <title>Add Product</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];

        // establish connection

        include("database.php");

        $query = "UPDATE Products SET (productName, productDescription, categoryID, quantity, price, size, color, discount, picture)
         VALUES ('$productName', '$productDescription', $category, $quantity, $price, $size, '$color', $discount, '$picture') WHERE productName LIKE '$productName'";

        // perform query

        $result = $con->query($query);
        if($result == true){
          echo "item sucessfully updated in table";
        }

        $con->close();
        
      ?>
  </body>
</html>