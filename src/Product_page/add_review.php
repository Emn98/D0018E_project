<?php 
  session_start();
?>



<?php

function RemoveSpecialChar($str) {
  
    // Using str_replace() function 
    // to replace the word 
    $res = str_replace( array( '\'', '"',
    ',' , ';', '<', '>' ), ' ', $str);

    // Returning the result 
    return $res;
    }

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$review_name = RemoveSpecialChar($_POST['review_name']);
$review_score = RemoveSpecialChar($_POST['review_score']);
$review_comment = RemoveSpecialChar($_POST['review_comment']);
$dislikes = 0;
$likes = 0;

print_r($_POST);
echo $user_id;

$stmt = $con->prepare("INSERT INTO USER_REVIEWS (user_id, product_id, review_name, review_score, review_comment, dislikes, likes, created_at) VALUES
(?,?,?,?,?,?,?,CURRENT_TIMESTAMP)");
$stmt->bind_param("iisisii", $user_id, $product_id, $review_name, $review_score, $review_comment, $dislikes, $likes);
$stmt->execute();

$stmt->close();

header("Location: /index.php");
exit;
?>