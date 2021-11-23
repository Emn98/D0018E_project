<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/main_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
  <div class="container">
    <header>
      <h1>OFF<span>BRAND</span></h1>
      <form class="search_bar_form" method="POST" action="/search.php">
        <input class="search_bar_inp" type="text" name="product_name">
        <button type="submit" class="search_btn">Search</button>
      </form> 
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <li><a href="/Shopping/shopping_cart.php"><i class="fa fa-sign-out"></i>Shopping cart</a></li>
        </ul>
      </nav>
      </header>