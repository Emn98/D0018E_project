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
          <input class="search_bar_inp" type="text" name="product_name">
          <button type="submit" class="search_btn">Search</button>
      </form> 
      <nav>
        <ul class="menu">
          <li><a href="Accounts/site_director.php">My page</a></li>
          <li><a href="test.php">Shopping cart</a></li>
        </ul>
      </nav>
    </header>
    <div class="categorie_list">
      <!-- This is categorie search -->
      <?php
      $path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "/database.php";
      include_once($path);

      $stmt = $con->prepare("SELECT * FROM  CATEGORIES");

      $stmt->execute();

      $result = $stmt->get_result();

      // print out list with categorie descriptions
      echo "<ul>";
      while ($row = $result->fetch_assoc()) {
        //echo "<li>". $row['category_description'] . "</li>";
        //echo "<li onclick="location.href = 'http://130.240.200.39/Category/gpu.php';">". $row['category_description'] . "</li>";
        echo "<li onclick="">". $row['category_description'] . "</li>";
      }
      echo "</ul>";

      ?>
    </div>
    <div class="search products">
    </div>
  </body>
</html>