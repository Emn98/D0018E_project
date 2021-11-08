<!-- This will serve as the main page for our e-comerce site offbrand.pwr-->
<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/main_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <header>
      <h1>OFF<span>BRAND</span></h1>
      <form class="search_bar_form" method="POST" action="search.php">
          <input class="search_bar_inp" type="text" name="Search products">
          <button type="submit" class="search_btn">Search</button>
      </form> 
      <nav>
        <ul class="menu">
          <li><a href="Accounts/site_director.php">My page</a></li>
          <li><a href="#">Shopping cart</a></li>
        </ul>
      </nav>
    </header>
  </body>
</html>