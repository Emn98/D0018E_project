<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM USER_REVIEWS WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$review_result = $stmt->get_result();
$stmt->fetch();


while($review = $review_result->fetch_assoc()){
  $review_name = $review['review_name'];
  $review_score = $review['review_score'];
  $review_created_at = $review['created_at'];
  $review_comment = $review['review_comment'];
  $like_to_dislike_ratio = $review['likes'] - $review['dislikes'];
  ?>
  <article class="each_review">
    <header>
      <div>
      <label><?php echo $review_name ?></label>
      <label><?php echo $review_score ?></label>
      </div>
      <time datetime="<?php echo $review_created_at ?>"><?php echo $review_created_at ?></time>
    </header>
    <p><?php echo $review_comment ?></p>
    <div>
      <div>
        <button>up</button>
        <label><?php echo $like_to_dislike_ratio ?></label>
        <button>down</button>
      </div>
    </div>
  </article>
 <?php 
}

$con->close();
?>
<form class="add_review_form" method="POST" action="add_review_form.php">
  <label>If you want to add a review click here</label>
  <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
  <button class="add_review_button">Add review</button>
</form>