<html>
  <head>
      <title>Edit Product</title>  
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

        $query = "INSERT INTO Products (productName, productDescription, categoryID, quantity, price, size, color, discount, picture)
         VALUES ('$productName', '$productDescription', $category, $quantity, $price, $size, '$color', $discount, '$picture')";

        // perform query

        $result = $conn->query($query);
        if($result == true){
          echo "item sucessfully added to table";
        }

        $conn->close();
        
      ?>
  </body>
</html>