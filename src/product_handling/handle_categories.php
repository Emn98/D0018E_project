<?php

//Establish connection to database. 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

if(isset($_POST["remove"])){
  $category_name = $_POST["category_to_delete"];
  
  $query = $con->prepare("UPDATE CATEGORIES SET is_deleted=? WHERE category_name=?");
  $query -> bind_param("is","1", $category_name);
  $query -> execute();
  $query->close();

  header("Location: handle_categories_form.php");
  exit;
}



?>