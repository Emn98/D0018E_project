<?php
session_start();

//Check so the user is logged in
require("log_in_check.php");

//creates connection to database
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$comment_id = $_POST['comment_id'];

$stmt = $con->prepare("DELETE * FROM USER_COMMENTS WHERE comment_id=?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();

?>
<div class="form">
<h3>Comment deleted successfully</h3>
<br> 
<a href="/index.php">Click here to continue</a>
</div>
