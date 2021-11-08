<html>
  <head>
      <title>Add Product</title>  
  </head>
  <body>
      
      <?php
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

        echo ($productName);

        $host = "localhost";
        $username = "phpmyadmin";
        $password = "Offbrand123$";
        $database = "Website";
        
        $mysqli = new mysqli($host,$username,$password, $database);

        echo("123");

        
        // error check for connection
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";


        $query = "INSERT INTO Products (ProductName, ProductDescription, CategoryID, Quantity, Price, Size, Color, Discount, Picture)
         VALUES ("$productName","$productDescription","$category","$quantity","$price","$size","$color","$discount","$picture")";

        // perform query

        echo("567");
        
        $result = $conn->query($query);

        if (!$mysqli->error) {
          printf("Errormessage: %s\n", $mysqli->error);
       }


        $conn->close();

        echo("345");

        
      ?>
  </body>
</html>