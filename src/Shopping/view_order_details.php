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
      <h1>OFF<span>BRAND</span></h1>
      <nav>
        <ul class="nav_menu">
          <li><a href="/index.php"><i class="fa fa-sign-out"></i>Home</a></li>
          <li><a href="/Accounts/site_director.php">My Page</a></li>
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
                  <th>Color</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
              <?php


$order_id = $_POST['order_id'];

$query = $con->prepare("SELECT product_id, quantity, color FROM ORDER_ITEMS WHERE order_id=?");
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
    $query2 = $con->prepare("SELECT product_name, price, discount, picture FROM PRODUCTS WHERE product_id=?");
    $query2->bind_param("i", $product_id);
    $query2->execute();
    $query2->bind_result($product_name, $price, $discount, $picture);
    $query2->fetch();
    $query2->close();
    if($temp == 1){
        echo "<tr class='table_row_odd'>";
        ?>
        <img src =<?php echo $picture ?>>
        <?php
        echo "<td>$product_name</td>";
        echo "<td>$color</td>";
        echo "<td>$quantity</td>";
        echo "<td>$price</td>";
        echo "<td>$discount</td>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        $temp = 0;
    }else{
        echo "<tr class='table_row_even'>";
        ?>
        <img src =<?php echo $picture ?>>
        <?php
        echo "<td>$product_name</td>";
        echo "<td>$color</td>";
        echo "<td>$quantity</td>";
        echo "<td>$price</td>";
        echo "<td>$discount</td>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        $temp = 1;
    }   
}

?>