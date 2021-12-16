<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Accounts/log_in_check.php";
require($path);

$user_id = $_SESSION["user_id"];

if(isset($_POST["purchase_date"]) && $_POST["purchase_date"]!= ""){

  $search_word = $_POST["purchase_date"];
  $search_word_prepare = "%$search_word%";
    
  $query = $con->prepare("SELECT order_id, purchase_date FROM USERS WHERE user_id=? and purchase_date LIKE ?");
  $query->bind_param("is", $user_id, $search_word_prepare);
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();
}else{
  //Retrive all orders associated with the logged in user. 
  $query = $con->prepare("SELECT order_id, purchase_date FROM ORDERS WHERE user_id=?");
  $query->bind_param("i", $user_id);
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="/Css/admin_delete_page.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Include JQuery library -->
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
      <title>Offbrand.pwr - Orders</title>
    </head>
    <body>
      <div class="container">
        <header>
        <h1 onclick="go_to_start()" style='cursor: pointer;'>OFFBRAND</h1>
          <nav>
            <ul class="nav_menu">
              <li><a href="/Accounts/site_director.php">Back</a></li>
            </ul>
          </nav>
        </header>
        <div class="user_container">
          <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" name="purchase_date" placeholder="Search Purchase Date...">
              <button type="submit"><i class="fa fa-search"></i>Search</button>
            </form>
            <form class="view_order_details" method="POST" action="/Shopping/view_order_details.php">
              <input type=hidden class=script_id name=order_id value="">
            </form>
            <script>
              function go_to_order_details(id){
              var order_id = id;
              $('.script_id').attr("value",order_id);//Insert the value of the category into the form on line 65. 
              $('.view_order_details').submit(); //Submit the form. 
              }
     </script>
          </div>
          <div class="inner_user_container">
            <h2>Orders</h2>
            <table>
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Purchase Date</th>
                  <th>View Details</th>
                </tr>
              </thead>
              <tbody>
                <?php

$temp = 1;
$form_id = 0;

while ($row = $result->fetch_assoc()) {
    $order_id = $row["order_id"];
    $purchase_date = $row["purchase_date"];
                
    if($temp == 1){
        echo "<tr class='table_row_odd'>";
        echo "<td>$order_id</td>";
        echo "<td>$purchase_date</td>";
        echo "<td>";
        ?> 
        <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
        <input type="button" value="View" onclick="go_to_order_details('<?php echo $order_id ?>')" class="view_btn">
        <?php
        echo "</td>";
        echo "</tr>";
        $temp = 0;
    }else{
        echo "<tr class='table_row_even'>";
        echo "<td>$order_id</td>";
        echo "<td>$purchase_date</td>";
        echo "<td>";
        ?> 
        <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
        <input type="button" value="View" onclick="go_to_order_details('<?php echo $order_id ?>')" class="view_btn">
        <?php
        echo "</td>";
        echo "</tr>";
        $temp = 1;
    }
  }

?>
<script>
  function go_to_start(){
    window.location.href = "/index.php";
    exit;
  }
</script>