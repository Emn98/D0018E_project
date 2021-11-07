<!-- This php script will redirect the user to the right page-->
<?php
  session_start();

  switch($_SESSION["customerID"]){
    case "":
      header("Location: log_in.php");
      exit;

    case 0:
      header("Location: admin_my_page.php");
      exit;

    default:
      header("Location: my_page.php");
  }
?>