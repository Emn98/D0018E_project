<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Remove Product</title>

    
  </head>
  <body>
    <div class="product_div">
      <div class="inner_product_div">
        <h1>Remove Product Page</h1>
   
        <form action="remove_product.php" method="post">
        <label for="product_name">Name</label>
        <select name="product_name" id="product_name">
        <?php

          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/database.php";
          include_once($path);

          $stmt = $con->prepare("SELECT * FROM PRODUCTS");
          
          $stmt->execute();

          $result = $stmt->get_result();
 
          while($row = $result->fetch_assoc()){
            $product_name = $row['product_name'];
            echo "<option value='$product_name'>$product_name</option>";
          }
          $con->close();
          
         ?>
         </select><br>
        <button type="submit" class="btn">Send</button>
        </form>

        <form action="/Accounts/admin_page.php" method="post">
          <button type="submit" class="btn">Return</button>
        </form>
      </div>
    </div>
  </body>
</html>