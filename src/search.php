<html lang="en">
  <head>
      <title>Search</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
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

        if($product_name == ""){
          $stmt = $con->prepare("SELECT * FROM PRODUCTS");
        } else{

          $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name LIKE ?");

          $stmt->bind_param("s", $product_name);
        }

        

        $stmt->execute();

        $result = $stmt->get_result();

        echo "<ul>";
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
            echo "<li>";
            echo "<div>";
            echo "<img src ='$picture' width = '200' height = '250'>" . "<br>";
            echo "$name". "<br>";
            echo "$description";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";

        $con->close();
        
      ?>

    <form action="index.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>