<?php
session_start();

//Check so the user is logged in
require("log_in_check.php");

//creates connection to database
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$review_id = $_POST['review_id'];

$stmt = $con->prepare("DELETE * FROM USER_COMMENTS WHERE review_id=?");
$stmt->bind_param("i", $review_id);
$stmt->execute();

$stmt = $con->prepare("DELETE * FROM USER_REVIEWS WHERE review_id=?");
$stmt->bind_param("i", $review_id);
$stmt->execute();

?>
<div class="form">
<h3>Review deleted successfully</h3>
<br> 
<a href="/index.php">Click here to continue</a>
</div>
