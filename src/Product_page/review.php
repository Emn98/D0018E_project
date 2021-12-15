<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM USER_REVIEWS WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$review_result = $stmt->get_result();
$stmt->fetch();
$stmt->close();


while($review = $review_result->fetch_assoc()){
  $review_id = $review['review_id'];
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
        <label><?php echo $review_score ?></label>
        </div>
        <time datetime="<?php echo $review_created_at ?>"><?php echo $review_created_at ?></time>
      </header>
      <p><?php echo $review_comment ?></p>
      <div>
        <div class="like_ratio_div">
          <button>up</button>
          <label><?php echo $like_to_dislike_ratio ?></label>
          <button>down</button>
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
          <div class="like_ratio_div">
            <button>up</button>
            <label><?php echo $comment_like_to_dislike_ratio ?></label>
            <button>down</button>
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

?>
<div class="add_review_div">
<form class="add_review_form" method="POST" action="add_review_form.php">
  <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
  <button class="add_review_button">Add review</button>
</div>
</form>