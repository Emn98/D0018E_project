<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/database.php";
include_once($path);

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Accounts/log_in_check.php";
require($path);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/shopping_cart_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
  <div class="container">
    <header>
      <h1 onclick="go_to_start()" style='cursor: pointer;'>OFFBRAND</h1>
      <nav>
        <ul class="nav_menu">
          <?php
            if($_SESSION["user_id"]==0){
              echo '<li><a href="/Accounts/view_all_orders.php">Back</a></li>';
            }else{
              echo ' <li><a href="/Accounts/site_director.php">Back</a></li>';
            } 
          ?>
        </ul>
      </nav>
      </header>
        <div class="shopping_cart">
          <div class="cart_container">
            <h2>Orders</h2>
            <table>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Name</th>
                  <th>Color</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              <?php


$order_id = $_POST['order_id'];

$query = $con->prepare("SELECT product_id, quantity, color, purchase_price FROM ORDER_ITEMS WHERE order_id=?");
$query->bind_param("i", $order_id);
$query->execute();
$order_result = $query->get_result();
$query->fetch();
$query->close();

$temp=1;
while ($row = $order_result->fetch_assoc()) {
    $product_id = $row["product_id"];
    $quantity = $row["quantity"];
    $color = $row["color"];
    $purchase_price = $row["purchase_price"];
    $query2 = $con->prepare("SELECT product_name, picture FROM PRODUCTS WHERE product_id=?");
    $query2->bind_param("i", $product_id);
    $query2->execute();
    $query2->bind_result($product_name, $picture);
    $query2->fetch();
    $query2->close();
    if($temp == 1){
        echo "<tr class='table_row_odd'>";
        echo "<td>";
        echo "<div class='product_display'>";
        ?>
        <img src ='<?php echo $picture ?>' alt="product"/>
        <?php
        echo "<td>$product_name</td>";
        echo "<td>$color</td>";
        echo "<td>$quantity</td>";
        echo "<td>$purchase_price</td>";
        $total_price = $purchase_price * $quantity;
        echo "<td>$total_price</td>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        $temp = 0;
    }else{
        echo "<tr class='table_row_even'>";
        echo "<td>";
        echo "<div class='product_display'>";
        ?>
        <img src =<?php echo $picture ?>>
        <?php
        echo "<td>$product_name</td>";
        echo "<td>$color</td>";
        echo "<td>$quantity</td>";
        echo "<td>$purchase_price</td>";
        $total_price = $purchase_price * $quantity;
        echo "<td>$total_price</td>";
        echo "<td>";
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
