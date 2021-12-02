<?php
require("check_admin.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
      <title>Edit Product</title>
  </head>
  <body>
    <div class="product_div">
        <div class="inner_product_div">
            <h1>Edit Product Page</h1>
            <form action="edit_product.php" id="redirect" method="post">
            <label>Old product name was: <?php echo $_POST['product_name'] ?><br></label>
            <input type="hidden" name="old_product_name" value=<?php echo $_POST['product_name'] ?>>
            <label>Edit information:</label><br>
            <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include($path);

            $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE product_name = ?");
            $stmt->bind_param("s", $_POST['product_name']);
            $stmt->execute();
            $result = $stmt->get_result();
            $p_info = $result->fetch_assoc();
            ?>
            <label for="new_product_name">New product name</label>
            <input type="text" id="new_product_name" name="new_product_name" value=<?php echo $p_info['product_name'] ?>>
            <label for="product_description">Description</label>
            <input type="text" id="description" name="product_description" placeholder="product description" value="<?php echo $p_info['product_description'] ?>" required><br>
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
            <input type="text" id="price" name="price" placeholder="price" value="<?php echo $p_info['price'] ?>" required><br>
            <label for="size">Size</label>
            <input type="text" id="size" name="size" placeholder="size" value="<?php echo $p_info['size'] ?>" required><br>
            <label for="discount">Discount</label>
            <input type="text" id="discount" name="discount" placeholder="discount" value="<?php echo $p_info['discount'] ?>" required><br>
            <label for="picture">Picture</label>
            <input type="text" id="picture" name="picture" placeholder="picture url" value="<?php echo $p_info['picture'] ?>" required><br>

            <?php

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include($path);

            $product_name = $_POST['product_name'];

            $stmt = $con->prepare("SELECT * FROM PRODUCT_INVENTORY WHERE product_id = (SELECT product_id FROM PRODUCTS WHERE product_name = ?)");
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $result_inventory = $stmt->get_result();
            $stmt->fetch();
            $stmt->close();

            echo "<table id='edit_table'>".
                    "<tr><td>Current Colors</td><td>Current Quantity</td></tr>"; 
            while($row_inventory = $result_inventory->fetch_assoc()){
                echo "<tr><td><input type='text' name='color[]' value=" . $row_inventory['color'] .  "><input type='hidden' name ='inventory_id[]' value=" . $row_inventory['inventory_id'] . "></td><td><input type='text' name='quantity[]' value=".$row_inventory['quantity'] . "></td></tr>";
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