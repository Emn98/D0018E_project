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
$deleted_categories=array();
?>
<!DOCTYPE html5>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/handle_category_style.css">
    <title>Edit category - Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <form class="category_handle" method="POST" action="handle_categories.php">
        <h2>Remove category</h2>    
        <label for="category_to_delete">Choose category to remove</label>
        <select name="category_to_delete">Delete category
          <?php
          while($row = $result->fetch_assoc()){
            $category_name = $row['category_name'];
            $is_deleted    = $row['is_deleted'];    
            if($is_deleted==0){
              echo "<option value='$category_name'>$category_name</option>";
            }else{
              array_push($deleted_categories,$category_name);
            }  
          }
          ?>    
        </select>
        <input type="hidden" value="delete" name="remove">
        <button type="submit" class="submit_btn">Submit</button>
      </form>
      <br>
      <form class="category_handle" method="POST" action="handle_categories.php">
        <h2>Reinstate deleted category</h2>
        <label for="category_to_reinstate">Choose category to reinstate</label>
        <select name="category_to_reinstate">Reinstate category
          <?php
          foreach ($deleted_categories as $value) {
            echo "<option value='$value'>$value</option>";
          }
          ?>    
        </select>
        <input type="hidden" name="reinstate" value="reinstate">
        <button type="submit" class="submit_btn">Submit</button>
      </form>
      <form class="go_back_form" method="" action="/Accounts/admin_page.php">
        <button class="back_btn" type="submit">Go Back</button>    
      </form>    
    </div>
  </body>    
</html>