<!-- This is the backend for the category add -->
<?php 

  //Checks so the admin is logged in
  require("check_admin.php");  

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $cat_name = $_POST["category_name"];
  $cat_description = $_POST["category_description"];

  //Check to see if the category already exists
  $cat_already_exists = $con->prepare("SELECT category_id WHERE category_name=?");
  $cat_already_exists->bind_param("s", $cat_name);
  $cat_already_exists->execute();
  $cat_already_exists->bind_results($category_id);
  $cat_already_exists->fetch();
  $cat_already_exists->close();

  echo(gettype($category_id));

  if($category_id==NULL){
      echo "works";
  }
?>