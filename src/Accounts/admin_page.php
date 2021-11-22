<?php 
  require("log_in_check.php");

?>

<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/Css/admin_page.css">
        <title>Admin page - Offbrand.pwr</title>
    </head>
    <body>
    <div class="container">
      <header>
        <img class="logo" src="/Images/logga2.png" alt="Logo"/>
        <nav>
          <ul class="nav_menu">
            <li><a href="/index.php">Home</a></li>
            <li><a href="log_out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div class="admin_menu_container">
          <h1>Welcome Admin</h1>
          <h2>Admin Menu</h2>
          <ul class="admin_menu">
            <li><a href='/product_handling/add_product_form.php'>Add Product</a></li>
            <li><a href='/product_handling/edit_product_form.php'>Edit product</a></li>
            <li><a href='/product_handling/remove_product_form.php'>Remove product</a></li>
            <li><a href='/Accounts/delete_user_admin_form.php'>Delete user</a></li>
          </ul>
        </div>
      </main>
	  </div>
    </body>
    </html>
