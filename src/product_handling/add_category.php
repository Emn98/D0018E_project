<!-- This is the backend for the category add -->
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/reg_page_2.css">
    <title>Add Category - Offbrand.pwr</title>
  </head>
  <body>
    <?php 
      //Checks so the admin is logged in
      require("check_admin.php");
  
      $path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "/database.php";
      include_once($path);

      $cat_name = $_POST["category_name"];
      $cat_description = $_POST["category_description"];
  
      //Check to see if the category already exists
      $query = $con->prepare("SELECT category_name FROM CATEGORIES WHERE category_name = ?");
      $query->bind_param("s", $cat_name);
      $query->execute();
      $query->bind_result($category_name_exists);
      $query->fetch();
      $query->close();
 
      if($category_name_exists==""){ //The category don't already exists. Create new category
        $query= $con->prepare("INSERT INTO CATEGORIES (category_name, category_description) VALUES (?, ?)");
        $query-> bind_param("ss", $cat_name, $cat_description);
        $query->execute();
        $query->close();
    
        //Relay to the user that the createion was a success
        echo "<div class='form'>";
        echo "<h3>Category Created Succesfully.</h3><br/>";
        echo "<p class='link'>Click here to <a href='/product_handling/add_category_form.php'>continue!</a>.</p>";
        echo "</div>";
    }else{
        //Relay to the user that the creation failed. 
        echo "<div class='form'>";
        echo "<h3>This Category Aldready Exists!</h3><br/>";
        echo "<p class='link'>Click here to <a href='/product_handling/add_category_form.php'>continue!</a>.</p>";
        echo "</div>";  
    } 
    ?>
  </body>
</html>