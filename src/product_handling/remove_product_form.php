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
        <input type="text" id="name" name="product_name" placeholder="product name"><br>
        <button type="submit" class="btn">Send</button>
        </form>

        <form action="/Accounts/my_page.php" method="post">
          <button type="submit" class="btn">Return</button>
        </form>
      </div>
    </div>
  </body>
</html>