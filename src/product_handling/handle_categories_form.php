<?php
//Checks so the admin is logged in. 
require("check_admin.php");

//Establish connection to database. 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM CATEGORIES");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html5>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/add_category_style.css">
    <title>Edit category - Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <form class="category_handle" method="POST" action="handle_categories.php">
        <h2>Remove category</h2>    
        <label for="category_to_delete">Choose category to remove</label>
        <select name="category_to_delete">
          <?php
          function not_deleted($category_name){
            echo "<option value='$category_name'>$category_name</option>";   
          } 
          ?>    
        </select>
      </form>
      <br>
      <form class="category_handle" method="POST" action="handle_categories.php">
        <h2>Reinstate deleted category</h2>
        <label for="category_to_reinstate">Choose categort to reinstate</label>
        <select name="category_to_reinstate">
          <?php
          function deleted($category_name){
            echo "<option value='$category_name'>$category_name</option>";   
          } 
          ?>    
        </select>
      </form>    
    </div>    
  </body>    
</html>