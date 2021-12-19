<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$user_id = $_SESSION["user_id"];

$stmt = $con->prepare("SELECT * FROM USER_REVIEWS WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$review_result = $stmt->get_result();
$stmt->fetch();
$stmt->close();


while($review = $review_result->fetch_assoc()){
  $review_id = $review['review_id'];
  $review_user_id = $review['user_id'];
  $review_name = $review['review_name'];
  $review_score = $review['review_score'];
  $review_created_at = $review['created_at'];
  $review_comment = $review['review_comment'];
  $like_to_dislike_ratio = $review['likes'] - $review['dislikes'];
  ?>
  <article class="each_review">
    <div class="only_review_div">
      <header>
        <div>
        <label><?php echo $review_name ?></label>
        <label><?php echo "Score $review_score/5" ?></label>
        </div>
        <time datetime="<?php echo $review_created_at ?>"><?php echo $review_created_at ?></time>
      </header>
      <p><?php echo $review_comment ?></p>
      <div>
        <?php
        if($user_id == $review_user_id && isset($user_id) || $user_id == 0 && isset($user_id)){
          ?>
          <button class="delete_button" value="Delete" onclick="delete_review('<?php echo $review_id ?>')">Delete</button>
          <?php
        }
        ?>
        <div class="like_ratio_div">
          <?php
          if(!has_pressed_like_button($user_id, $review_id,1)){
            echo "<button onclick='add_like($user_id, $review_id)'><i class='fa fa-thumbs-up'></i></button>";
          } else{
            echo "<button><i class='fa fa-thumbs-up'></i></button>";
          }
          ?>
          <label><?php echo $like_to_dislike_ratio ?></label>
          <?php
          if(!has_pressed_like_button($user_id, $review_id,0)){
            echo "<button onclick='add_dislike($user_id, $review_id)'><i class='fa fa-thumbs-down'></i></button>";
          } else{
            echo "<button><i class='fa fa-thumbs-down'></i></button>";
          }
          ?>
        </div>
      </div>
    </div>
    <?php
    
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include($path);

    $stmt = $con->prepare("SELECT * FROM USER_COMMENTS WHERE review_id=?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $comment_result = $stmt->get_result();
    $stmt->fetch();

    while($comment = $comment_result->fetch_assoc()){
      $comment_id = $comment['comment_id'];
      $comment_user_id = $comment['user_id'];
      $comment_name = $comment['comment_name'];
      $comment_created_at = $comment['created_at'];
      $comment_comment = $comment['comment_comment'];
      $comment_like_to_dislike_ratio = $comment['likes'] - $comment['dislikes'];
      ?>
      <article class="each_comment">
        <header>
          <div>
          <label><?php echo $comment_name ?></label>
          </div>
          <time datetime="<?php echo $comment_created_at ?>"><?php echo $comment_created_at ?></time>
        </header>
        <p><?php echo $comment_comment ?></p>
        <div>
          <?php
          if($user_id == $comment_user_id && isset($user_id) || $user_id == 0 && isset($user_id)){
            ?>
            <button class="delete_button" value="Delete" onclick="delete_comment('<?php echo $comment_id ?>')">Delete</button>
            <?php
          }
          ?>
          <div class="like_ratio_div">
            <button><i class="fa fa-thumbs-up"></i></button>
            <label><?php echo $comment_like_to_dislike_ratio ?></label>
            <button><i class="fa fa-thumbs-down"></i></button>
          </div>
        </div>
      </article>
      <?php
    }
    
    $stmt->close();
    ?>
    <div class="add_comment_div">
      <form class="add_comment_form" method="POST" action="add_comment_form.php">
      <input type="hidden" name="review_id" value="<?php echo $review_id ?>">
      <button class="add_comment_button">Add comment</button>
      </form>
    </div>
  </article>
  <?php
}

$stmt->close();
if($user_id != 0){
?>
<div class="add_review_div">
<form class="add_review_form" method="POST" action="add_review_form.php">
  <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
  <button class="add_review_button">Add review</button>
</div>
</form>
<?php
}
?>
<script>
        function delete_review(id){
          if (confirm("Would you like to delete review?")){
            $.ajax({
                type: "POST",
                url:  "delete_review.php", // 
                data: {review_id: id},                
                success: function(){
                  alert("Review deleted successfully!");
                  location.reload();
                },
                error: function(response){
                    console.log(response)
                    alert("failure");
                }
            });
          }
        }
        function delete_comment(id){
          if (confirm("Would you like to delete comment?")){
            $.ajax({
                type: "POST",
                url:  "delete_comment.php", // 
                data: {comment_id: id},                
                success: function(){
                  alert("Comment deleted successfully!");
                  location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
          }
        }

        function add_like($u_id, $r_id){
          $.ajax({
                type: "POST",
                url:  "add_like.php", // 
                data: {user_id: u_id, review_id: r_id},                
                success: function(){
                  alert("like added successfully!");
                  location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
        }
        function add_dislike($u_id, $r_id){
          $.ajax({
                type: "POST",
                url:  "add_dislike.php", // 
                data: {user_id: u_id, review_id: r_id},                
                success: function(){
                  alert("dislike added successfully!");
                  location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
        }
</script>

<?php

function has_pressed_like_button($u_id, $r_id, $decide){
  if($decide == 1){
    //user pressed like button

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include($path);

    $stmt = $con->prepare("SELECT * FROM USER_LIKES_REVIEW WHERE user_id=? AND review_id=?");
    $stmt->bind_param("ii",$u_id, $r_id);
    $stmt->execute();
    $has_liked = $stmt->get_result();
    $stmt->fetch();
    $stmt->close();

    if($has_liked){
      $link = $has_liked->fetch_assoc();
      if(!$link['user_liked']){
        return TRUE;
      } else{
        return FALSE;
      }
    } else{
      return TRUE;
    }
  } else{
    //user pressed dislike button

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include($path);

    $stmt = $con->prepare("SELECT * FROM USER_LIKES_REVIEW WHERE user_id=? AND review_id=?");
    $stmt->bind_param("ii",$u_id, $r_id);
    $stmt->execute();
    $has_liked = $stmt->get_result();
    $stmt->fetch();
    $stmt->close();

    if($has_liked){
      $link = $has_liked->fetch_assoc();
      if(!$link['user_disliked']){
        return TRUE;
      } else{
        return FALSE;
      }
    } else{
        return TRUE;
      }
  }
}