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

        include("database.php");

        $query = "UPDATE PRODUCTS SET product_name='$product_name', product_description='$product_description', category_id=$category,
         quantity=$quantity, price=$price, size=$size, color='$color', discount=$discount, picture='$picture' WHERE product_name LIKE '$product_name'";

        // perform query

        $result = $con->query($query);
        if($result == true){
          echo "item sucessfully updated in table";
        }

        $con->close();
        
      ?>
  </body>
</html>