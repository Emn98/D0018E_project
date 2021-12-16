<!-- This will serve as the main page for our e-comerce site offbrand.pwr-->
<?php 
  session_start();

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  //Retrive info from the 4 latest added product
  $query = $con->prepare("SELECT product_id, product_name, product_description, price, discount, picture FROM PRODUCTS ORDER BY product_id DESC LIMIT 20");
  $query->execute();
  $recently_added = $query->get_result();
  $query->fetch();
  $query->close();

?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/main_page.css">
    <link rel="stylesheet" href="/Css/product_card_style.css">
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
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
     </div>
      <nav>
        <ul class="nav_menu">
          <li><a href="/Accounts/site_director.php">My Page</a></li>
          <?php 
            if($_SESSION["user_id"] != 0){
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
        <div class="inner_right_side" style="display: block;">
          <div class="latest_products">
            <form class="view_product" method="POST" action="/Product_page/product_details.php">
              <input type="hidden" class="form_inp" value="" name="product_id">
            </form>
            <?php 
            while ($row = $recently_added->fetch_assoc()) {
              $product_name = $row["product_name"];
              $product_id = $row["product_id"];
              $product_description = $row["product_description"];
              $price = $row["price"];
              $discount = $row["discount"];
              $img = $row["picture"];
              ?>
              <div class="card">
                <img src="<?php echo $img; ?>" width="170" height="200">
                <h2><?php echo $product_name; ?></h2>
                <p class="description"><?php echo $product_description; ?></p>
                <?php 
                  if($discount==0){
                echo "<p class='price'>$$price </p>"; 
              }else{
                echo "<p class='price'><strike> $$price</strike></p>"; 
                echo "<p class='price' style='color:red';>$$discount <p>"; 
              }
            ?>
            <input type="button" value="View" onclick="go_to_product('<?php echo $product_id ?>')"  class="view_btn">
            </div>
            <?php  
            }
            ?>
          </div>
      </main>
      <div class="left_side"></div>
      <div class="right_side">
      </div>
	</div>
    <script> 
      function go_to_product(id){
        var product_id = id;
        $('.form_inp').attr("value",product_id);//Insert the value of the category into the form on line 24. 
        $('.view_product').submit(); //Submit the form. 
       }
    </script>
  </body>
</html>
