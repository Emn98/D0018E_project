<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM USER_REVIEWS WHERE product_id=? ORDER BY (likes - dislikes) DESC LIMIT 1");
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
    </article>
  <?php
}
$stmt->close();
?>
