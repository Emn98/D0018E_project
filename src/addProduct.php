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
        
        $mysqli = new mysqli("localhost","Offbrand123$","Website");


        // error check for connection
        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();

        }

        // perform query
        $result = $mysqli -> query("INSERT INTO Products
        (`ProductName`, `ProductDescription`, `CategoryID`, `Quantity`, `Price`,
        `Size`, `Color`, `Discount`, `Picture`)
         VALUES ($productName, $productDescription, $category, $quantity,
        $price, $size, $color, $discount, $picture)";


      ?>
  </body>
</html>