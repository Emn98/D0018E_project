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
  <div class="container">
      <header>
      <h1>OFF<span>BRAND</span></h1>
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <li><a href="#"><i class="fa fa-sign-out"></i>Shopping cart</a></li>
        </ul>
      </nav>
      </header>
      <main>Main
          <ul class="category_list_ul">
          <li><a href="/Category/gpu.php">GPU</a></li>
          <li><a href="/Category/cpu.php">CPU</a></li>
        </ul>
      </main>
      <div class="left_side">Left Side</div>
      <div class="right_side">Right Side</div>
	</div>
  </body>
</html>