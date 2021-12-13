<?php 
  //Checks so the admin is logged in
  require("check_admin.php");
?>
<!-- This site will allow the admin to add categories to the site -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/add_category_style.css">
    <title>Add category - Offbrand.pwr</title>
  </head>
  <body>
    <div class="input_container">
      <form class="add_category_form" method="POST" action="add_category.php">
        <h1>Add New Category</h1>
        <div class="form_elements">
          <label for="category_name" class="form_label">Name</label>
          <input type="text" id="category_name" name="category_name" class="category_input" placeholder="Category name" maxlength="20" required>
        </div>
        <div class="form_elements">
          <label for="category_description" class="form_label">Category</label>
          <textarea id="category_description" name="category_description" class="category_input_text" placeholder="Category description" maxlength="255" required></textarea>
        </div>
         <button class="form_button">Submit</button>  
      </form>
      <form class="cancel_form" method="" action="/Accounts/admin_page.php">
        <button class="cancel_btn">Cancel</button>
      </form>
    </div>
  </body>
</html>