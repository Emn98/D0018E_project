<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Edit Product</title>

    <div>
      <h1>Edit Product Page</h1>
    </div>
  </head>
  <body>
        <form action="edit_product.php" method="post">
        <label for="product_name">Name</label>
        <input type="text" id="name" name="product_name" placeholder="product name"><br>
        <label for="product_description">Description</label>
        <input type="text" id="description" name="product_description" placeholder="product description"><br>
        <label for="category">Category</label>
        <input type="text" id="category" name="category" placeholder="category"><br>
        <label for="quantity">Quantity</label>
        <input type="text" id="quantity" name="quantity" placeholder="quantity"><br>
        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="price"><br>
        <label for="size">Size</label>
        <input type="text" id="size" name="size" placeholder="size"><br>
        <label for="color">Color</label>
        <input type="text" id="color" name="color" placeholder="color"><br>
        <label for="discount">Discount</label>
        <input type="text" id="discount" name="discount" placeholder="discount"><br>
        <label for="picture">Picture</label>
        <input type="text" id="picture" name="picture" placeholder="picture url"><br>
        <input type="submit" placeholder="Send">
        </form>
  </body>
</html>