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
    <link rel="stylesheet" href="Css/category.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
    <title>Offbrand.pwr</title>
  </head>
  <body>
  <div class="container">
    <header class="top_nav_bar">
      <h1>OFF<span>BRAND</span></h1>
      <div class="search_bar_container">
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name" placeholder="Search...">
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
     </div>
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <li><a href="/Shopping/shopping_cart.php">Shopping cart</a></li>
        </ul>
      </nav>
    </header>
      <main>
        <div class="inner_left_side">
        <?php 
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/Category/categories_file2.php";
            include($path);
            ?>
        </div>
        <div class="inner_right_side">
        <h3>Newly added</h3>
          <div class="latest_products">
            <div class="card">
  <img src="https://www.logitechg.com/content/dam/gaming/en/products/pro-gaming-mouse/plasma-hero-hero.png" alt="Denim Jeans" style="width:100%">
  <h3>Test</h3>
  <p>Some text about the jeans..</p>
  <p class="price">$19.99</p>
  <p><button>Buy</button></p>
            </div>
            <div class="card">
  <img src="https://www.logitechg.com/content/dam/gaming/en/products/pro-gaming-mouse/plasma-hero-hero.png" alt="Denim Jeans" style="width:100%">
  <h3>Test</h3>
  <p>Some text about the jeans..</p>
  <p class="price">$19.99</p>
  <p><button>Buy</button></p>
            </div>
            <div class="card">
  <img src="https://www.logitechg.com/content/dam/gaming/en/products/pro-gaming-mouse/plasma-hero-hero.png" alt="Denim Jeans" style="width:100%">
  <h3>Test</h3>
  <p>Some text about the jeans..</p>
  <p class="price">$19.99</p>
  <p><button>Buy</button></p>
            </div>
            <div class="card">
  <img src="https://www.logitechg.com/content/dam/gaming/en/products/pro-gaming-mouse/plasma-hero-hero.png" alt="Denim Jeans" style="width:100%">
  <h3>Test</h3>
  <p>Some text about the jeans..</p>
  <p class="price">$19.99</p>
  <p><button>Buy</button></p>
            </div>
          </div>

        </div>
      </main>
      <div class="left_side"></div>
      <div class="right_side">
      </div>
	</div>
  </body>
</html>
