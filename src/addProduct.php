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

        // perform query
        $result = $conn->query('INSERT INTO `Products`( `ProductName`, `ProductDescription`, `CategoryID`, `Quantity`,
         `Price`, `Size`, `Color`, `Discount`, `Picture`)
          VALUES (\"A\",\"A\",1,1,1,1,1,1,\"A\")');

        echo("345");

        
      ?>
  </body>
</html>