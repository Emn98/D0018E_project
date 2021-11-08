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

        echo ("$productName");

        $host = "localhost";
        $username = "phpmyadmin";
        $password = "Offbrand123$";
        $database = "Website";
        
        $conn = new mysqli($host,$username,$password, $database);

        echo("123");

        
        // error check for connection
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";

        
        $query = "CREATE DATABASE TUTORIALS";
         /*$query = "INSERT INTO Products (ProductName, ProductDescription, CategoryID, Quantity, Price, Size, Color, Discount, Picture)
         VALUES ("$productName","$productDescription",$category, $quantity, $price, $size, $color, $discount, "$picture")";
        */

        // perform query

        echo("567");

        $result = $conn->query($query);
        
        if (!$conn->error) {
          printf("Errormessage: %s\n", $conn->error);
       }


        $conn->close();

        echo("345");

        
      ?>
  </body>
</html>