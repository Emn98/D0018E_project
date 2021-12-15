<!-- This php scirpt will check if the logged in user have a order in the database and
if not it will create one for him/her -->
<?php
  //Check so the user is logged in.  
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/Accounts/log_in_check.php";
  require($path);

  session_start();

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $user_id = $_SESSION["user_id"];

  //Check if the user have a shopping order in the database
  if(gettype($_SESSION["order_id"]) == "NULL" || !isset($_SESSION["order_id"])){
    $query = $con->prepare("INSERT INTO ORDERS (user_id) VALUES(?)");//If not create the order
    $query -> bind_param("i", $user_id);
    $query -> execute();
    $query->close();

    //Kollar den senaste inlagda Order_id som tillagts i Databasen
    $query = $con->prepare("SELECT MAX(order_id) FROM ORDERS WHERE user_id=?");
    $query -> bind_param("i", $user_id);
    $query -> execute();
    $query->bind_result($order_id);
    $query->fetch();
    $query->close();

    $_SESSION["order_id"] = $order_id;
  }
?>