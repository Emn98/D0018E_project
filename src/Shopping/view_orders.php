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
    $query = $con->prepare("SELECT order_id, purchase_date FROM ORDERS WHERE user_id>?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////


$temp = 1;
$form_id = 0;

echo "test";
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
        <input type="button" action="view_order_details.php" class="view_order_btn">
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
        <input type="button" action="view_order_details.php" class="view_order_btn">
        <?php
        echo "</td>";
        echo "</tr>";
        $temp = 1;
    }
  }

?>