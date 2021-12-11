<?php 

  //Checks so the admin is logged in
  require("admin_check.php");

?>
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">
    <title>Add category - Offbrand.pwr</title>
  </head>
  <body>
    <form class="add_category_form" method="POST" action="add_category.php">
        <h1>Add New Category</h1>
        <input type="text" id="category_name" name="category_name" class="category_input" placeholder="Category name" required>
        <textarea id="category_description" name="category_description" class="category_input" placeholder="Category description" maxlength="255" require>
        <input type="submit" class="submit_btn" value="Add category">    
    </form>
    <form class="cancel_form" method="" action="/Accounts/admin_page.php">
        <button class="cancel_btn">Cancel</button>
    </form>
  </body>
</html>