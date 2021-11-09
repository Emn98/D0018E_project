<!-- This php script will redirect the user to the right page-->
<?php
  session_start();

  if(isset($_SESSION["customerID"])){
    header("Location: my_page.php");
    exit;
  }else{
    header("Location: login_page.php");
    exit;
  }
?>