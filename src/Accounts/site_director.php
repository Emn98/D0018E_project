<!-- This php script will redirect the user to my page or log in page... 
depending on the users logged in status-->
<?php
  session_start();

  if(!isset($_SESSION["user_id"])){
    header("Location: login_page_form.php");
    exit;
  }elseif($_SESSION["user_id"]!= 0){
    header("Location: my_page.php");
    exit;
  }else{
    header("Location: admin_page.php");
    exit;
  }
?>