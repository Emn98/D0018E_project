<!-- This will serve as the main page for our e-comerce site offbrand.pwr-->

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
    <div class = "grid-container">
      <div class = "item1">
        <h1>OFF<span>BRAND</span></h1>
        <form class="search_bar_form" method="POST" action="/search.php">
            <input class="search_bar_inp" type="text" name="product_name">
            <button type="submit" class="search_btn">Search</button>
        </form> 
        <nav>
          <ul class="menu">
            <li><a href="/Accounts/site_director.php">My page</a></li>
            <li><a href="/test.php">Shopping cart</a></li>
          </ul>
        </nav>
      </div>
      <div class="item2">
        
        <!-- This is categorie search -->
        
        <ul class="category_list_ul">
          <li><a href="/Category/gpu.php">GPU</a></li>
          <li><a href="/Category/cpu.php">CPU</a></li>
        </ul>
        
      </div>
      <div class="item3">

      </div>
    </div>
  </body>
</html>