<?php 
  session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/main_page.css">
    <link rel="stylesheet" href="/Css/present_products.css">
    <link rel="stylesheet" href="/Css/product_card_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/javascript.js"></script>
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
    <header class="top_nav_bar">
    <h1 onclick="go_to_start()" style='cursor: pointer;'>OFFBRAND</h1>
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
          <h2 class="title_header"><?php echo $_POST['product_name']; ?></h2>
          <form class="view_product" method="POST" action="/Product_page/product_details.php">
            <input type="hidden" class="form_inp" value="" name="product_id">
          </form>
            <?php

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include_once($path);

            $product_name = $_POST['product_name'];
            $search_word = "%$product_name%";

            if($product_name == ""){
              $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE category_id IN (SELECT category_id FROM CATEGORIES WHERE is_deleted = 0)");
            } else{

              $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE WHERE category_id IN (SELECT category_id FROM CATEGORIES WHERE is_deleted = 0) AND product_name LIKE ?");

              $stmt->bind_param("s", $search_word);
            }

            $stmt->execute();

            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
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
            $con->close();
            
            ?>
          </div>
        </main>
        <div class="left_side"></div>
        <div class="right_side"></div>
    </div>
    <script>
      function go_to_product(id){//This function will submit the form making the user go to
        var product_id = id;     //the product page. 
        $('.form_inp').attr("value",product_id);
        $('.view_product').submit();
      }

      function go_to_start(){
      window.location.href = "/index.php";
      exit;
      }
    </script>
  </body>
</html>