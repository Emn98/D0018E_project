<html>
  <head>
      <title>Search</title>  
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $productName = $_POST['Search products'];
    
        // establish connection

        include("database.php");

        $query = "SELECT * FROM Products WHERE productName LIKE '$productName'";

        $result = $con->query($query);

        echo "<table>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $name   = $row['productName'];
            $description = $row['productDescription'];
            $category = $row['categoryID'];
            $quantity   = $row['quantity'];
            $price = $row['price'];
            $size = $row['size'];
            $color = $row['color'];
            $description = $row['discount'];
            $category = $row['picture'];
            echo "<tr><td>".$name."</td><td>".$description."</td><td>".
            $category."</td></tr>".$quantity."</td></tr>".$price."</td><td>".
            $size."</td><td>".$color."</td></tr>".$discount."</td></tr>".$picture."</td></tr>";
        }
        echo "</table>";
 

        $con->close();
        
      ?>
  </body>
</html>