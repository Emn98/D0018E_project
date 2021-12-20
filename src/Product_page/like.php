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
        $type = $_POST['type'];
        $result = 0;
        $zero = 0;
        $one = 1;
        
        //check if there is a review
        $stmt = $con->prepare("SELECT * FROM USER_LIKES_REVIEW WHERE user_id=? AND review_id=?");
        $stmt->bind_param("ii", $user_id, $review_id);
        $stmt->execute();
        $r = $stmt->get_result();
        $stmt->fetch();
        $stmt->close();
        
        //check if its add or remove like ($type)
        if($type==1){
          if(mysqli_num_rows($r)>0) {

            $row = $r->fetch_assoc();

            //set dislike=0, like=1
            $stmt = $con->prepare("UPDATE USER_LIKES_REVIEW SET user_disliked=?, user_liked=? WHERE user_id=? AND review_id=?");
            $stmt->bind_param("iiii", $zero, $one, $user_id, $review_id);
            $stmt->execute();
            $stmt->close();
            
            //remove dislike if review had already been disliked
            if($row['user_disliked']){
            $stmt = $con->prepare("UPDATE USER_REVIEWS SET dislikes = (dislikes-1) WHERE review_id=?");
            $stmt->bind_param("i", $review_id);
            $stmt->execute();
            $stmt->close();
            }
          } else{
            //add a link between user and review for likes if there is non already  
            $stmt = $con->prepare("INSERT INTO USER_LIKES_REVIEW (user_id, review_id, user_disliked, user_liked) VALUES(?,?,?,?)");
            $stmt->bind_param("iiii", $user_id, $review_id, $zero, $one);
            $stmt->execute();
            $stmt->close();
              
          }
          // add like to review
          $stmt = $con->prepare("UPDATE USER_REVIEWS SET likes = (likes+1) WHERE review_id=?");
          $stmt->bind_param("i", $review_id);
          $stmt->execute();
          $stmt->close();
        
      } else{
          //set dislike=0, like=0
          $stmt = $con->prepare("UPDATE USER_LIKES_REVIEW SET user_disliked=?, user_liked=? WHERE user_id=? AND review_id=?");
          $stmt->bind_param("iiii", $zero, $zero, $user_id, $review_id);
          $stmt->execute();
          $stmt->close();
          //remove like from review
          $stmt = $con->prepare("UPDATE USER_REVIEWS SET likes = (likes-1) WHERE review_id=?");
          $stmt->bind_param("i", $review_id);
          $stmt->execute();
          $stmt->close();
      }
        ?>
        <div class="form">
        <h3>Comment deleted successfully</h3>
        <br> 
        <a href="/index.php">Click here to continue</a>
        </div>
    </body>
  </html>