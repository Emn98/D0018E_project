<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Edit Product</title>
  </head>
  <body>
    <div class="product_div">
        <div class="inner_product_div">

            <h1>Edit Product Page</h1>
            <form action="edit_product.php" method="post">
            <label>Edit information:</label><br>
            <label for="product_description">Description</label>
            <input type="text" id="description" name="product_description" placeholder="product description" required><br>
            <label for="category">Category</label>
            <select name="category" id="category">
            <?php

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include($path);

            $stmt = $con->prepare("SELECT * FROM CATEGORIES");
            
            $stmt->execute();

            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
            $category_name = $row['category_name'];
            echo "<option value='$category_name'>$category_name</option>";
            }
            $con->close();
            ?>
            </select>
            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="price" required><br>
            <label for="size">Size</label>
            <input type="text" id="size" name="size" placeholder="size" required><br>
            <label for="discount">Discount</label>
            <input type="text" id="discount" name="discount" placeholder="discount" required><br>
            <label for="picture">Picture</label>
            <input type="text" id="picture" name="picture" placeholder="picture url" required><br>

            <?php

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include($path);

            $product_name = $_POST['product_name'];

            echo gettype($product_name);

            print_r($_POST);

            $stmt = $con->prepare("SELECT * FROM PRODUCT_INVENTORY WHERE product_id = (SELECT product_id FROM PRODUCTS WHERE product_name = ?)");
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $result_inventory = $stmt->get_result();
            $stmt->fetch();
            $stmt->close();

            echo "after request";

            
            echo "<table>".
                    "<tr><td>Current Colors</td><td>Current Quantity</td></tr>"; 
            while($row_inventory = $result_inventory->fetch_assoc()){
                echo "<tr><td contenteditable='true'>" . $row_inventory['color'] . "</td><td contenteditable='true'>" . $row_inventory['quantity'] . "</td></tr>";
            }
            echo "</table>"; 
            ?>   
            <button type="submit" class="btn">Send</button>
            </form>

            <form action="/Accounts/admin_page.php" method="post">
            <button type="submit" class="btn">Return</button>
            </form>
        </div>
    </div>
  </body>
</html>