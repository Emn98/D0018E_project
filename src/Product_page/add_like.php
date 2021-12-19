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

        $user_id = $_POST['user_id'];
        $review_id = $_POST['review_id'];
    
        $stmt = $con->prepare("SELECT COUNT(*) FROM USER_LIKES_REVIEW WHERE user_id = ? AND review_id=?");
        $stmt->bind_param("ii", $user_id, $review_id);
        $stmt->bind_result($result);
        $stmt->execute();

        if($result > 0){
            $stmt = $con->prepare("UPDATE USER_LIKES_REVIEW SET user_liked=? WHERE user_id = ? AND review_id=?");
            $stmt->bind_param("iii", 1, $user_id, $review_id);
            $stmt->execute(); 
        } else{
            $stmt = $con->prepare("INSERT INTO USER_LIKES_REVIEW (user_id, review_id, user_disliked, user_liked) VALUES (?,?,?,?)");
            $stmt->bind_param("iiii", $user_id, $review_id, 0, 1);
            $stmt->execute();
        }

        $stmt = $con->prepare("UPDATE USER_REVIEWS SET likes = likes+1 WHERE user_id = ? AND review_id=?");
        $stmt->bind_param("ii",$user_id, $review_id);
        $stmt->execute();


        ?>
        <div class="form">
        <h3>Comment deleted successfully</h3>
        <br> 
        <a href="/index.php">Click here to continue</a>
        </div>
    </body>
  </html>