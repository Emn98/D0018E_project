<?php
require("check_admin.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Add Product</title>
  </head>
  <body>
    <div class="product_div">
      <div class="inner_product_div">
        <h1>Add Product Page</h1>

        <form action="add_new_color_product.php" method="post">
        <input type="hidden" value="<?php echo $_POST['product_id'] ?>"> 
        <label for="quantity">Quantity</label>
        <input type="text" id="quantity" name="quantity" placeholder="quantity" required><br>
        <label for="color">Color</label>
        <input type="text" id="color" name="color" placeholder="color" required><br>
        <button type="submit" class="btn">Send</button>
        </form>

        <form action="/Accounts/admin_page.php" method="post">
          <button type="submit" class="btn">Return</button>
        </form>
      </div>
    </div>
  </body>
</html>
<?php

?>