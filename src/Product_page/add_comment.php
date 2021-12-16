<?php 
session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: /Accounts/login_page_form.php");
    exit;
  }

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
include($path);

$user_id = $_SESSION['user_id'];
$review_id = $_POST['review_id'];
$comment_name = RemoveSpecialChar($_POST['comment_name']);
$comment_comment = RemoveSpecialChar($_POST['comment_comment']);
$dislikes = 0;
$likes = 0;

print_r($_POST);

$stmt = $con->prepare("INSERT INTO USER_COMMENTS (review_id, user_id, comment_name, comment_comment, dislikes, likes, created_at) VALUES
(?,?,?,?,?,?, CURRENT_TIMESTAMP)");
$stmt->bind_param("iissii", $review_id, $user_id, $comment_name, $comment_comment, $dislikes, $likes);
$stmt->execute();
$stmt->close();


header("Location: /index.php");
exit;
?>