<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$user_id = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT * FROM USER_REVIEWS WHERE product_id=? ORDER BY (likes - dislikes) DESC LIMIT 1");
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
                <div class="stars">
               <?php
                for ($x = 0; $x <5; $x++) {
                    if($average_score >= 1){
                        echo '<i class="fa fa-star checked" style="color:orange;"></i>';
                    }elseif($average_score >= 0.5 && $average_score < 1){
                        echo '<i class="fa fa-star-half-o" style="color:orange;"></i>';
                    }else{
                        echo '<i class="fa fa-star" style="color:#cdcdcd;"></i>';
                    }
                    $average_score -= 1;
                }
               ?>   
              </div> 
                </div>
                <time datetime="<?php echo $review_created_at ?>"><?php echo $review_created_at ?></time>
            </header>
            <p><?php echo $review_comment ?></p>
            <div>
                <?php
                if($user_id == $review_user_id && isset($user_id) || $user_id == 0 && isset($user_id)){
                    ?>
                    <button class="delete_button" value="Delete" onclick="delete_review('<?php echo $review_id ?>')">delete</button>
                    <?php
                }
                ?>
                <div class="like_ratio_div">
                    <button><i class="fa fa-thumbs-up"></i></button>
                    <label><?php echo $like_to_dislike_ratio ?></label>
                    <button><i class="fa fa-thumbs-down"></i></button>
                </div>
            </div>
        </div>
    </article>
  <?php
}
$stmt->close();
?>
