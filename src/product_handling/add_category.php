<!-- This is the backend for the category add -->
<?php 

  //Checks so the admin is logged in
  require("check_admin.php");
  
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $cat_name = $_POST["category_name"];
  $cat_description = $_POST["category_description"];
  
  //Check to see if the category already exists
  $email_exist = $con->prepare("SELECT category_name FROM CATEGORIES WHERE category_name = ?");
  $email_exist->bind_param("s", $cat_name);
  $email_exist->execute();
  $email_exist->bind_result($category_name_exists);
  $email_exist->fetch();
  $email_exist->close();

  //echo $category_name_exists;
 
  if($category_name_exists==""){ //The category don't already exists. Create new category
    $query= $con->prepare("INSERT INTO CATEGORIES (category_name, category_description) VALUES (?, ?)");
    $query-> bind_param("ss", $cat_name, $cat_description);
    $query->execute();
    $query->close();
    display_creation_success();
  }else{
    display_creation_failure();
  }
?>
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/add_category_response_style.css">
    <title>My Page - Offbrand.pwr</title>
  </head>
  <body>
      <?php
        function display_creation_success(){ //Draw out confirmation that the category have been created  
      ?>
        <div class='form'>
          <h3>Category Created Succesfully.</h3><br/>
          <p class='link'>Click here to <a href='/product_handling/add_category_form.php'>continue!</a>.</p>
        </div>
      <?php 
        }      
      ?>
      <?php
      function display_creation_failure(){ //Draw out confirmation that the category have been created  
      ?>
        <div class='form'>
          <h3>This Category aldready exists</h3><br/>
          <p class='link'>Click here to <a href='/product_handling/add_category_form.php'>continue!</a>.</p>
        </div>
      <?php 
      }      
      ?>
  </body>
</html>
