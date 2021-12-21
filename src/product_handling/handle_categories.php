<?php

if(isset($_POST["remove"])){
  $category_name = $_POST["category_to_delete"];

  //Establish connection to database. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include($path);

  $inp = 1;
  
  $query = $con->prepare("UPDATE CATEGORIES SET is_deleted=? WHERE category_name=?");
  $query -> bind_param("is",$inp, $category_name);
  $query -> execute();
  $query->close();

  header("Location: handle_categories_form.php");
  exit;
}

if(isset($_POST["reinstate"])){
    $category_name = $_POST["category_to_reinstate"];
  
    //Establish connection to database. 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include($path);
  
    $inp = 0;
    
    $query = $con->prepare("UPDATE CATEGORIES SET is_deleted=? WHERE category_name=?");
    $query -> bind_param("is",$inp, $category_name);
    $query -> execute();
    $query->close();
  
    header("Location: handle_categories_form.php");
    exit;
  }



?>