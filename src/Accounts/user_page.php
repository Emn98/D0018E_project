<!-- This will act as the userpage for our website --> 
<?php
  require("log_in_check.php");

  session_start();

  include("/Accounts/log_in_check.php");

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  //Retrive the users data from the database
  $query = $con->prepare("SELECT first_name, last_name, email_address, t_number, address_1, address_2, city, postal_code FROM USERS WHERE user_id=?");
  $query->bind_param("s", $_SESSION["user_id"]);
  $query->execute();
  $query->bind_result($first_name, $last_name, $email_address, $tel_nr, $address_1, $address_2, $city, $postal_code);
  $query->fetch();
  $query->close();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/user_page.css">
    <title>My Page - Offbrand.pwr</title>
  </head>
  <body>
    <div class="container">
      <header>
        <h1>OFF<span>BRAND</span></h1>
        <div class="search_bar_container">
        <form class="search_bar_form" method="POST" action="/search.php">
          <input class="search_bar_inp" type="text" name="product_name" placeholder="Search...">
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
        </div>
        <nav>
          <ul class="nav_menu">
            <li><a href="/index.php">Home</a></li>
            <li><a href="#">Order history</a></li>
            <li><a href="log_out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div class="user_info_box">
          <h1>Welcome <?php echo "$first_name";?></h1>
          <h2>Account Information</h2>
          <table>
            <tr>
              <th class="category">NAME</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$first_name $last_name";?></th>
            </tr>
            <tr>
              <th class="category">Email Address</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$email_address";?></th>
            </tr>
            <tr>
              <th class="category">Telephone Number</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$tel_nr";?></th>
            </tr>        
            <tr>
              <th class="category">Address</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$address_1";?></th>
            </tr> 
            <?php
              if($address_2 != ""){//Only displays the care-of-address if one is set.
                echo "<tr>";
                echo "<th class='category'>Care-Of-Address<th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th class='value'>'$address_2'<th>";
                echo "</tr>";
            ?>
            <tr>
              <th class="category">City</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$city";?></th>
            </tr> 
            <tr>
              <th class="category">Postal code</th>
            </tr>
            <tr>
              <th class="value"><?php echo "$postal_code";?></th>
            </tr>         
          </table>
          <form action="edit_user_form.php">
            <button class="edit_user_info_btn">Edit user</button>
          </form>
        </div>
      </main>
	  </div>
  </body>
</html>