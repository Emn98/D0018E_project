<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel='stylesheet' href='/Css/delete_user_response.css'>
      <title>Offbrand.pwr</title>
    </head>
    <body>
        <?php
        session_start();

        //Check so the user is logged in
        include("log_in_check.php");

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include($path);

        $review_id = $_POST['review_id'];
        $product_id = $_POST['product_id'];
        echo "this is where to look at" + $product_id;

        $stmt = $con->prepare("DELETE FROM USER_COMMENTS WHERE review_id=?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();

        $stmt = $con->prepare("DELETE FROM USER_REVIEWS WHERE review_id=?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();

        $stmt = $con->prepare("SELECT AVG(review_score) FROM USER_REVIEWS WHERE product_id=?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($average_score);
        $stmt->fetch();
        $stmt->close();
      
        $stmt = $con->prepare("UPDATE PRODUCTS SET average_score=? WHERE product_id=?");
        $stmt->bind_param("di", $average_score, $product_id);
        $stmt->execute();
        $stmt->close();

        ?>
        <div class="form">
        <h3>Review deleted successfully</h3>
        <br> 
        <a href="/index.php">Click here to continue</a>
        </div>
    </body>
  </html>