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
        if (mysqli_connect_errno()) {
          echo("Failed to connect to MySQL: " . $mysqli -> connect_error);
          exit();

        }

        // perform query
        $result = mysqli_query($mysqli, $sql  = 'INSERT INTO Products\n"

        . "        (ProductName, ProductDescription, CategoryID, Quantity, Price,\n"
    
        . "        Size, Color, Discount, Picture)\n"
    
        . "         VALUES (\'$productName\', \'$productDescription\', \'$category\', \'$quantity\',\n"
    
        . "        \'$price\', \'$size\', \'$color\', \'$discount\', \'$picture\')';

        echo("345");

        
      ?>
  </body>
</html>