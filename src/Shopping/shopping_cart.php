<!-- This will serve as the shopping cart page for our e-comerce site offbrand.pwr-->
<?php
  
  //require("/Accounts/log_in_check.php");//Check so the user is logged in
  //require("check_shopping.php");//Checks so the user have an shopping cart. if not, create one
  
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
          <li><a href="/index.php"><i class="fa fa-sign-out"></i>Home</a></li>
        </ul>
      </nav>
      </header>
        <div class="shopping_cart">
          <div class="cart_container">
            <h2>Shopping cart</h2>
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
                <tr class="table_row_odd">
                  <td>
                    <div class="product_display">
                      <img src="/Images/test.png" alt="product"/>
                      <div class="product_info">
                        <p>test</p>
                        <small>remove</small>
                      </div>
                    </div>
                  </td>
                  <td>color</td>
                  <td>1</td>
                  <td>50.00$</td>
                </tr>
                <tr class="table_row_even">
                 <td>
                    <div class="product_display">
                      <img src="/Images/test.png" alt="product"/>
                      <div class="product_info">
                        <p>test</p>
                        <small>remove</small>
                      </div>
                    </div>
                  </td>                  
                  <td>color 2</td>
                  <td>2</td>
                  <td>43.00$</td>
                </tr>
                <tr class="table_row_odd">
                  <td>
                    <div class="product_display">
                      <img src="/Images/test.png" alt="product"/>
                      <div class="product_info">
                        <p>test</p>
                        <small>remove</small>
                      </div>
                    </div>
                  </td>
                  <td>color</td>
                  <td>1</td>
                  <td>50.00$</td>
                </tr>
                <tr class="table_row_even">
                  <td>
                    <div class="product_display">
                      <img src="/Images/test.png" alt="product"/>
                      <div class="product_info">
                        <p>test</p>
                        <small>remove</small>
                      </div>
                    </div>
                  </td>
                  <td>color 2</td>
                  <td>2</td>
                  <td>43.00$</td>
                </tr>                
              </tbody>
            </table>
          </div>
        </div>
        <div class="shopping_cart_info">Info</div>    
      <div class="left_side">Left Side</div>
      <div class="right_side">Right Side</div>
	</div>
  </body>
</html>