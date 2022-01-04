<?php

if(isset($_POST["remove"]) && $_POST["category_to_delete"]!=""){
  $category_name = $_POST["category_to_delete"];

  //Establish connection to database. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include($path);

  $inp = 1;
  
  $query = $con->prepare("UPDATE PRODUCTS SET is_deleted=? WHERE product_name=?");
  $query -> bind_param("is",$inp, $category_name);
  $query -> execute();
  $query->close();

  header("Location: remove_product_form.php");
  exit;
}

if(isset($_POST["reinstate"]) && $_POST["category_to_reinstate"]!=""){
    $category_name = $_POST["category_to_reinstate"];

    //Establish connection to database. 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include($path);
  
    $inp = 0;
    
    $query = $con->prepare("UPDATE PRODUCTS SET is_deleted=? WHERE product_name=?");
    $query -> bind_param("is",$inp, $category_name);
    $query -> execute();
    $query->close();
  
    header("Location: remove_product_form.php");
    exit;
  }

header("Location: remove_product_form.php");
exit;  
?>