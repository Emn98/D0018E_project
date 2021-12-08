<?php 
  session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Add Review</title>
  </head>
  <body>
    <div class="product_div">
      <div class="inner_product_div">
        <h1>Add Review Page</h1>
        <label><?php echo $_SESSION['user_id'] ?></label>
        <form action="add_review.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
        <label for="review_name">Name</label>
        <input type="text" id="name" name="review_name" placeholder="review name" required><br>
        <label for="review_score">Review score</label>
        <input type="number" id="review_score" name="review_score" placeholder="review score" min="0" max="5" required><br>    
        <label for="review_comment">Review comment</label>
        <input type="text" id="review_comment" name="review_comment" placeholder="review comment" required><br>
        <button type="submit" class="btn">Send</button>    
        </form>

        <form action="/index.php" method="post">
          <button type="submit" class="btn">Return to home</button>
        </form>
      </div>
    </div>
  </body>
</html>
