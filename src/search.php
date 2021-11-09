<html>
  <head>
      <title>Search</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/add_product.css">
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
    
        // establish connection

        include("database.php");

        $query = "SELECT * FROM PRODUCTS WHERE product_name LIKE '$product_name'";

        $result = $con->query($query);

        echo "<table>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $name   = $row['product_name'];
            $description = $row['product_description'];
            $category = $row['category_id'];
            $quantity   = $row['quantity'];
            $price = $row['price'];
            $size = $row['size'];
            $color = $row['color'];
            $discount = $row['discount'];
            $picture = $row['picture'];
            echo "<tr><td>".$name."</td><td>".$description."</td><td>".
            $category."</td></tr>".$quantity."</td></tr>".$price."</td><td>".
            $size."</td><td>".$color."</td></tr>".$discount."</td></tr>".$picture."</td></tr>";
        }
        echo "</table>";
 

        $con->close();
        
      ?>
  </body>
</html>