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
    <link rel="stylesheet" href="/Css/product_card_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
    <title>Offbrand.pwr</title>
  </head>
  <body>
  <div class="container">
    <header class="top_nav_bar">
      <h1>OFFBRAND</h1>
      <div class="search_bar_container">
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name" placeholder="Search...">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
     </div>
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <?php 
            if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] != 0){//Don't display shopping cart to admin
              echo '<li><a href="/Shopping/shopping_cart.php">Shopping cart</a></li>';
            }
          ?>
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
          <?php 
          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/front_page_products.php";
          include($path);
          ?>
        </div>
      </main>
      <div class="left_side"></div>
      <div class="right_side">
      </div>
	</div>
    <script> 
      function go_to_product(id){//This function will submit the form making the user go to
        var product_id = id;     //the product page. 
        $('.form_inp').attr("value",product_id);
        $('.view_product').submit();
       }
    </script>
  </body>
</html>
