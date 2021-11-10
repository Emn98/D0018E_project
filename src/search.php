<html lang="en">
  <head>
      <title>Search</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/product.css">
  </head>
  <body>
      
      <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $product_name = $_POST['product_name'];
    
        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name LIKE ?");

        $stmt->bind_param("s", $product_name);

        $stmt->execute();

        $result = $stmt->get_result();

        echo "<table>";
        while ($row = $result->fetch_assoc()) {
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

    <form action="index.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>