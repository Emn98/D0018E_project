

<?php
?>
<label>This works right?</label>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM REVIEWS WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$review_result = $stmt->get_result();
$stmt->fetch();


while($review = $review_result->fetch_assoc()){
  $review_name = $reveiw['name'];
  $review_score = $review['review_score'];
  $review_comment = $review['review_comment'];
  $like_to_dislike_ratio = $review['likes'];
  ?>
  <div class="each_review_div">
    <label><?php echo $name ?></label><br>
    <label><?php echo $review_score ?></label><br>
    <label><?php echo $review_comment ?></label><br>
    <label><?php echo $like_to_dislike_ratio ?></label><br>
  </div>
 <?php 
}
$con->close();
?>