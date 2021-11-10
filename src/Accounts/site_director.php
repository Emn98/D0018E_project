<!-- This php script will redirect the user to my page or logg in page... 
depending on the users logged in status-->
<?php
  session_start();

  if(isset($_SESSION["user_id"])){
    header("Location: my_page.php");
    exit;
  }else{
    header("Location: login_page.php");
    exit;
  }
?>