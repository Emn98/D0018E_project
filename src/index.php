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
      <form class="search_bar_form" method="POST" action="/search.php">
        <input class="search_bar_inp" type="text" name="product_name">
        <button type="submit" class="search_btn">Search</button>
      </form> 
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <li><a href="/Shopping/shopping_cart.php">Shopping cart</a></li>
        </ul>
      </nav>
      </header>
      <main>Main

        

        <ul class="category_list_ul">
          <li><a href='javascript:void(0)' class='button' var='/Category/category.php'>GPU</a></li>
          <form method="post" name="redirect" class="redirect">
          <input type="hidden" class="post" name="post" value="1">
          <input type="submit" style="display: none;">
          </form>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
            $(".button").click(function() {
            var link = $(this).attr('var');
            $('.post').attr("value",link);
            $('.redirect').submit();
            });
          </script>
        </ul>
      </main>
      <div class="left_side">Left Side</div>
      <div class="right_side">Right Side</div>
	</div>
  </body>
</html>