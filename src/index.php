<!-- This will serve as the main page for our e-comerce site offbrand.pwr-->
<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="sv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <header>
      <h1>OFF<span>BRAND</span></h1>
      <div class="search_bar_box">
      <form method="POST" action="search.php">
          <input type="text" name="Sök produkter" placeholder="Sök produkter">
          <input type="submit" name="Sök" value="Sök">
      </form> 
      </div>
      <nav>
        <ul class="menu">
          <li><a href="Accounts/my_site_director.php">Min sida</a></li>
          <li><a href="#">kundvagn</a></li>
        </ul>
      </nav>
    </header>
  </body>
</html>