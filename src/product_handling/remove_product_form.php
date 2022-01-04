<?php
//Checks so the admin is logged in. 
require("check_admin.php");

//Establish connection to database. 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include($path);

$stmt = $con->prepare("SELECT * FROM PRODUCTS");
$stmt->execute();
$result = $stmt->get_result();
$deleted_categories=array();
?>
<!DOCTYPE html5>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/handle_category_style.css">
    <title>Remove item - Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <form class="category_handle" method="POST" action="remove_product.php">
        <h2>Remove item</h2>    
        <label for="category_to_delete">Choose item to remove</label>
        <select name="category_to_delete">Delete item
          <?php
          while($row = $result->fetch_assoc()){
            $category_name = $row['product_name'];
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
      <form class="category_handle" method="POST" action="remove_product.php">
        <h2>Reinstate deleted item</h2>
        <label for="category_to_reinstate">Choose item to reinstate</label>
        <select name="category_to_reinstate">Reinstate item
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