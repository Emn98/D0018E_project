<?php 
session_start();

if(!isset($_SESSION["user_id"])){
  header("Location: /Accounts/login_page_form.php");
  exit;
}

?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Add Comment</title>
  </head>
  <body>
    <div class="product_div">
      <div class="inner_product_div">
        <h1>Add Comment Page</h1>
        <form action="add_comment.php" method="POST">
        <input type="hidden" name="review_id" value="<?php echo $_POST['review_id'] ?>">
        <label for="comment_name">Name</label>
        <input type="text" id="name" name="comment_name" placeholder="comment name" required><br>
        <label for="comment_comment">comment</label>
        <input type="text" id="comment_comment" name="comment_comment" placeholder="comment" required><br>
        <button type="submit" class="btn">Send</button>    
        </form>

        <form action="/index.php" method="POST">
          <button type="submit" class="btn">Return to home</button>
        </form>
      </div>
    </div>
  </body>
</html>
